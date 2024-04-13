<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchReport;
use App\Models\BranchTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardsController extends Controller
{
    //  ADMIN
    public function adminIndex()
    {
        return view(
            'dashboard',
            [
                'dash' => $this->adminDashboard(),
                'reports_top' => $this->top20()

            ]
        );
    }

    protected function top20()
    {
        return  BranchReport::query()
            ->select([
                'divisions.division_name', 'branches.church_name',
                'service_date',
                'branches.currency',
                'name_of_preacher',
                'theme_and_sermon',
                'services.service',
                'amalgamation',
                'branch_reports.id'
            ])
            ->selectRaw('(female + male + children) As attendance, (tithe + first_offering + second_offering + thanksgiving + special_offering + cell_offering) as total_income')
            ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
            ->join('divisions', 'branches.division_id', '=', 'divisions.id')
            ->join('services', 'branch_reports.service_id', '=', 'services.id')
            ->whereYear('service_date', now()->year)
            ->offset(0)->limit(20)
            ->orderBy('service_date', 'desc')
            ->get();
    }

    protected function adminDashboard()
    {
        $data = [];
        $data['reports_count'] = DB::table('branch_reports')->whereYear('service_date', now()->year)->count();
        $data['active_churches'] = DB::table('branches')->where('church_status', 'Active')->count();


        return $data;
    }

    //  BRANCH
    public function branchIndex()
    {
        //return $this->branchID();
        return view(
            'dashboard-branch',
            [
                'dash' => $this->branchDashboard(),
                'target' => BranchTarget::where('branch_id', $this->branchID())->get(),
                'branch' => $this->getBranchInfo(),
                'reports_top' => $this->branchTop20()
            ]
        );
    }

    protected function branchTop20()
    {
        return  BranchReport::query()
            ->select([
                'divisions.division_name', 'branches.church_name',
                'service_date',
                'branches.currency',
                'name_of_preacher',
                'theme_and_sermon',
                'services.service',
                'amalgamation',
                'branch_reports.id'
            ])
            ->selectRaw('(female + male + children) As attendance, (tithe + first_offering + second_offering + thanksgiving + special_offering + cell_offering) as total_income')
            ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
            ->join('divisions', 'branches.division_id', '=', 'divisions.id')
            ->join('services', 'branch_reports.service_id', '=', 'services.id')
            ->whereYear('service_date', now()->year)->where('branch_id', $this->branchID())
            ->offset(0)->limit(20)
            ->orderBy('service_date', 'desc')
            ->get();
    }

    protected function branchDashboard()
    {
        $data = [];
        $data['reports_count'] = DB::table('branch_reports')->where('branch_id', $this->branchID())->whereYear('service_date', now()->year)->count();
        $data['sum_income'] = (object)DB::select('select COALESCE(SUM(tithe + first_offering + second_offering + thanksgiving + special_offering + cell_offering),0) AS sum_income from `branch_reports` where branch_id = ? and MONTH(service_date) = ?', [$this->branchID(), now()->month])[0];
        $data['avg_attendance'] = DB::select('select COALESCE(AVG(male + female + children),0) AS avg_attendance from `branch_reports` where branch_id = ? and MONTH(service_date) = ? and service_id = ?', [$this->branchID(), now()->month, '100'])[0];

        //table('branch_reports')->where('branch_id', $this->branchID())->whereMonth()
        //dd($data);       $data['branches_count'] = DB::table('branches')->where('church_status', 'Active')->count();
        return $data;
    }
    protected function branchID()
    {
        return auth()->user()->user_role_id;
    }
    protected function getBranchInfo()
    {
        return Branch::findOrFail($this->branchID());
    }
}
