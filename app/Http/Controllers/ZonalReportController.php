<?php

namespace App\Http\Controllers;

use App\Http\Traits\GlobalValuesCore;
use App\Models\Branch;
use App\Models\BranchReport;
use App\Models\Service;
use App\Models\ZonalReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ZonalReportController extends Controller
{
    use GlobalValuesCore;
    //ZONAL 
    public function zonalIndex()
    {

        return view(
            'dashboard-zonal',
            [
                'dash' => [], //$this->branchDashboard(),

                'branches' => $this->zoneBranches(),
                'zonereports' =>  $this->topZoneReports()
            ]
        );
    }

    protected function topZoneReports()
    {
        try {

            $res =  ZonalReport::select(
                'zonal_reports.created_at',
                'br.church_name',
                'report_year',
                'report_month',
                'month_key',
                'branch_visited',
                'total_tithe',
                'total_first_offering',
                'amalgamation_paid',
                'algamation_correct',
                'records_verified'
            )
                ->join('branches as br', 'zonal_reports.branch_id', '=', 'br.id')
                ->where('zonal_reports.zone_id', auth()->user()->user_role_id)
                ->where('report_year', now()->year)
                ->orderBy('church_name')->orderBy('month_key', 'desc')
                ->get(); //


            return $res;
        } catch (\Exception $exception) {
            Log::error('  - error: ' . $exception->getMessage());
        }
    }

    protected function zoneBranches()
    {
        return Branch::select(
            'church_name',
            'church_location',
            'church_status',
            'church_email',
            'city',
            'branch_pastor',
            'id',
            DB::raw('(select count(*) from branch_reports where year(service_date)=' . now()->year . ' and branch_id=branches.id) as reports')
        )
            ->where('zone_id', auth()->user()->user_role_id)

            ->get();
    }

    public function index(Request $request)
    {
        return view(
            'zonal.zonal-report-index',
            [
                'months' => $this->getMonths(),
                'years' => $this->getZoneReportYear(),
                'reports' => $this->zoneReports($request),

            ]
        );
    }

    public function create(Request $request)
    {
        $branch = request()->get('branch');
        $year = request()->get('year');
        $month = request()->get('month');

        return view(
            'zonal.zonal-report-create',
            [
                'months' => $this->getMonths(),
                'years' => [now()->year - 1, now()->year],
                'yesno' => ['YES', 'NO'],
                'incdec' => ['INCREASED', 'DECREASED', 'NO CHANGE'],
                'church' => Branch::findOrFail(request()->get('branch')),
                'findata' => $this->ajaxFinRecord($branch, $year, $month)
            ]
        );
    }

    public  function show(ZonalReport $zonalreport)
    {
        return view(
            'zonal.zonal-report-show',
            [
                'report' => $zonalreport,
                'church' => Branch::findOrFail($zonalreport->branch_id),
                'findata' => $this->ajaxFinRecord($zonalreport->branch_id, $zonalreport->report_year, $zonalreport->month_key)
            ]
        );
    }

    public function store(Request $request)
    {
        //$request->all();
        $attributes = $this->FormValidation($request);
        $attributes['month_key'] = $attributes['report_month'];
        $attributes['report_month']  = $this->getMonths()->where('monthkey', $attributes['report_month'])->pluck('month')[0];
        $attributes['zone_id']  = auth()->user()->user_role_id;
        //check if record already exists
        if (DB::table('zonal_reports')
            ->where('report_year', $attributes['report_year'])
            ->where('month_key', $attributes['month_key'])
            ->where('branch_id', $attributes['branch_id'])
            ->exists()
        ) {
            throw ValidationException::withMessages(['errrormessage' => 'Report already in the system [Report for branch, month and year is already captured]. Process abored!']);
        }
        try {

            //return $attributes;
            ZonalReport::create($attributes);

            return back()->with(['success' => 'Zone report saved successfully !']);
        } catch (\Exception $ex) {
            Log::info('error - zonal report ::' . $ex);
            //throw ValidationException::withMessages(['errrormessage' => $ex]);
        }
    }

    protected function FormValidation(Request $request): array
    {
        ///$branch ??= new Branch();
        return  $request->validate([
            'report_year' => 'required|min:4',
            'report_month' => 'required',
            'branch_id' => ['required', Rule::exists('branches', 'id')],
            'total_first_offering' => 'required',
            'total_tithe' => 'required',
            'check_amalgamation' => 'required',
            'amalgamation_paid' => 'required|numeric',
            'branch_visited' => 'required',
            'pastor_follow_teaching' => 'required',
            'algamation_correct' => 'required',
            'attendance_inc_dec' => 'required',
            'attendance_verified' => 'required',
            'records_verified' => 'required',
            'pastor_corporate' => 'required',
            'zonal_comments' => 'nullable',
        ]);
    }

    ///AJAX CALLS////
    protected function ajaxFinRecord($branch, $year, $month)
    {
        return BranchReport::selectRaw('sum(first_offering) as first_offering, sum(tithe) as tithe,sum(amalgamation) as amalg')
            ->where('branch_id', $branch)
            ->whereYear('service_date', $year)
            ->whereMonth('service_date', $month)
            ->first();
    }

    public function branchReports(Request $request)
    {
        return
            view('zonal.br.zone-branch-report-index', [
                'months' => $this->getMonths(),
                'years' => $this->getReportYear(),
                'reports' => $this->ReportSummary($request)
            ]);
    }

    protected function zoneReports(Request $request)
    {
        try {
            $data = $request->validate([
                'year' => 'required',
                'month' => 'nullable',
            ]);


            $res = [];
            if ($data['month'] == '') {
                $res =  ZonalReport::select(
                    'zonal_reports.id',
                    'zonal_reports.created_at',
                    'br.church_name',
                    'report_year',
                    'report_month',
                    'month_key',
                    'branch_visited',
                    'total_tithe',
                    'total_first_offering',
                    'amalgamation_paid',
                    'algamation_correct',
                    'records_verified'
                )
                    ->join('branches as br', 'zonal_reports.branch_id', '=', 'br.id')
                    ->where('zonal_reports.zone_id', auth()->user()->user_role_id)
                    ->where('report_year', $data['year'])
                    ->orderBy('church_name')->orderBy('month_key', 'desc')
                    ->get(); //
            } else {

                $res =   $res =  ZonalReport::select(
                    'zonal_reports.id',
                    'zonal_reports.created_at',
                    'br.church_name',
                    'report_year',
                    'report_month',
                    'month_key',
                    'branch_visited',
                    'total_tithe',
                    'total_first_offering',
                    'amalgamation_paid',
                    'algamation_correct',
                    'records_verified'
                )
                    ->join('branches as br', 'zonal_reports.branch_id', '=', 'br.id')
                    ->where('zonal_reports.zone_id', auth()->user()->user_role_id)
                    ->where('report_year', $data['year'])
                    ->where('month_key', $data['month'])
                    ->orderBy('church_name')->orderBy('month_key', 'desc')
                    ->get(); //

            }

            return $res;
        } catch (\Exception $exception) {
            Log::error('  - error: ' . $exception->getMessage());
        }
    }

    public function ReportSummary(Request $request)
    {
        try {
            $data = $request->validate([
                'year' => 'required',
                'month' => 'nullable',
            ]);


            $res = [];
            if ($data['month'] == '') {
                $res =  BranchReport::selectRaw('br.church_name,br.id as brID, year(service_date) as year,monthName(service_date) as month, month(service_date) as mm,sum(tithe) as tithe,
                sum(first_offering) as first_offering, sum(amalgamation) as amalgamation,sum(cell_offering) as cell_offering, SUM(male+female+children) as attendance,
                SUM(tithe + first_offering + second_offering + thanksgiving + special_offering + cell_offering) as total
                ')
                    ->join('branches as br', 'branch_reports.branch_id', '=', 'br.id')
                    ->where('br.zone_id', auth()->user()->user_role_id)
                    ->whereYear('service_date', $data['year'])
                    ->groupBy('church_name', 'year', 'mm', 'month', 'brID')
                    ->orderBy('church_name')->orderBy('year')
                    ->get(); //
            } else {

                $res =  BranchReport::selectRaw('br.church_name, br.id as brID,  year(service_date) as year,monthName(service_date) as month,month(service_date) as mm, sum(tithe) as tithe,
                sum(first_offering) as first_offering, sum(amalgamation) as amalgamation,sum(cell_offering) as cell_offering, SUM(male+female+children) as attendance,
                SUM(tithe + first_offering + second_offering + thanksgiving + special_offering + cell_offering) as total
                ')
                    ->join('branches as br', 'branch_reports.branch_id', '=', 'br.id')
                    ->where('br.zone_id', auth()->user()->user_role_id)
                    ->whereYear('service_date', $data['year'])
                    ->whereMonth('service_date', $data['month'])
                    ->groupBy('church_name', 'year', 'mm', 'month', 'brID')
                    ->orderBy('church_name')->orderBy('year')
                    ->get(); //

            }

            return $res;
        } catch (\Exception $exception) {
            Log::error('  - error: ' . $exception->getMessage());
        }
    }


    public function branchReportShow(Request $request)
    {
        return
            view('zonal.br.zone-branch-report-detail-index', [
                'months' => $this->getMonths(),
                'years' => $this->getReportYear(),
                'branches' => $this->zoneBranches(),
                'reports' => $this->ReportDetails($request)
            ]);
    }

    public function ReportDetails(Request $request)
    {
        try {
            $data = $request->validate([
                'branch' => 'required',
                'year' => 'required',
                'month' => 'nullable',
            ]);


            $res = [];
            if ($data['month'] == '') {
                $res =  BranchReport::select(
                    'branch_reports.id',
                    'br.church_name',

                    'service_date',
                    'ss.service',
                    'theme_and_sermon',
                    'female',
                    'male',
                    'name_of_preacher',
                    'tithe',
                    'first_offering',
                    'amalgamation',
                    'tithe',
                    'first_offering',
                    'second_offering',
                    'thanksgiving',
                    'special_offering',
                    'cell_offering',
                    'cells',
                    'cells_met',
                    'report_by',
                    'br.currency'
                )
                    ->join('branches as br', 'branch_reports.branch_id', '=', 'br.id')
                    ->join('services as ss', 'branch_reports.service_id', '=', 'ss.id')
                    ->where('branch_reports.branch_id', $data['branch'])
                    ->whereYear('service_date', $data['year'])
                    ->orderBy('church_name')->orderBy('service_date', 'desc')
                    ->get(); //
            } else {
                $res =  BranchReport::select(
                    'branch_reports.id',
                    'br.church_name',
                    'service_date',
                    'ss.service',
                    'theme_and_sermon',
                    'female',
                    'male',
                    'name_of_preacher',
                    'tithe',
                    'first_offering',
                    'amalgamation',
                    'tithe',
                    'first_offering',
                    'second_offering',
                    'thanksgiving',
                    'special_offering',
                    'cell_offering',
                    'cells',
                    'cells_met',
                    'report_by',
                    'br.currency'
                )
                    ->join('branches as br', 'branch_reports.branch_id', '=', 'br.id')
                    ->join('services as ss', 'branch_reports.service_id', '=', 'ss.id')
                    ->where('branch_reports.branch_id', $data['branch'])
                    ->whereYear('service_date', $data['year'])
                    ->whereMonth('service_date', $data['month'])
                    ->orderBy('church_name')->orderBy('service_date', 'desc')
                    ->get(); //

            }

            return $res;
        } catch (\Exception $exception) {
            Log::error('  - error: ' . $exception->getMessage());
        }
    }


    public function branchReportDetailsShow(BranchReport $branchreport)
    {
        return view(
            'branch.services.br-service-show',
            [
                'services' => Service::all(),
                'report' => $branchreport
            ]
        );
    }


    public function branchReportDetailsEdit(string $id)
    {
        return view(
            'zonal.br.br-service-edit',
            [
                'services' => Service::all(),
                'report' => BranchReport::findOrFail($id)
            ]
        );
    }
}
