<?php

namespace App\Http\Controllers;

use App\Http\Traits\GlobalValuesCore;
use App\Models\Branch;
use App\Models\BranchProperty;
use App\Models\BranchReport;
use App\Models\ZonalReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportGenerationController extends Controller
{

    use GlobalValuesCore;
    //SERVICE
    public function branchReports(Request $request)
    {
        return //$this->RepDataAll($request);
            view('admin.reports.service-reports', [
                'months' => $this->getMonths(),
                'years' => $this->getReportYear(),
                'divisions' => $this->getDivisions(),
                'reportdata' => $this->BranchReportDataAll($request)
            ]);
    }
    public function BranchReportDataAll(Request $request)
    {
        try {
            $data = $request->validate([
                'division_id' => 'required',
                'year' => 'required',
                'month' => 'nullable',
                'church_id' => 'nullable'
            ]);


            $res = [];
            if ($data['month'] == '') {
                $res =  BranchReport::select(['branch_reports.*', 'divisions.division_name', 'branches.church_name', 'branches.currency', 'services.service'])
                    ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                    ->join('divisions', 'branches.division_id', '=', 'divisions.id')
                    ->join('services', 'branch_reports.service_id', '=', 'services.id')
                    ->where('branches.division_id', $data['division_id'])
                    ->where('branch_id', 'like', '%' . $data['church_id'] . '%')
                    ->whereYear('service_date', $data['year'])
                    ->orderBy('branch_id')->orderBy('service_date', 'desc')
                    ->get();
            } else {
                $res =  BranchReport::select(['branch_reports.*', 'divisions.division_name', 'branches.church_name', 'branches.currency', 'services.service'])
                    ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                    ->join('divisions', 'branches.division_id', '=', 'divisions.id')
                    ->join('services', 'branch_reports.service_id', '=', 'services.id')
                    ->where('branches.division_id', $data['division_id'])
                    ->where('branch_id', 'like', '%' . $data['church_id'] . '%')
                    ->whereYear('service_date', $data['year'])
                    ->whereMonth('service_date', $data['month'])
                    ->orderBy('branch_id')->orderBy('service_date', 'desc')
                    ->get();
            }

            return $res;
        } catch (\Exception $exception) {
            Log::error('All report - error: ' . $exception->getMessage());
        }
    }

    //ATTENDANCE
    public function attendanceReport(Request $request)
    {
        return //$this->RepDataAll($request);
            view('admin.reports.attendance-reports', [
                'months' => $this->getMonths(),
                'years' => $this->getReportYear(),
                'select_divzone' => ['Division', 'Zone', 'Branch'],
                'divisions' => $this->getDivisions(),
                'reportdata' => $this->AttendanceReportData($request)
            ]);
    }
    public function AttendanceReportData(Request $request)
    {
        try {
            $data = $request->validate([
                'div_zone' => 'required',
                'year' => 'required',
                'month' => 'nullable',
                'division_id' => 'nullable',
            ]);


            $res = [];
            if ($data['div_zone'] == 'Division') { //Division 
                if ($data['month'] == '') {
                    $res =  BranchReport::selectRaw('service_date, division_name, SUM(female) as female, SUM(male) as male, SUM(children) as children, SUM(avg_cell_attendance) as avg_cell_attendance, 
                    SUM(female + male + children + avg_cell_attendance) as totalAttendance,
                    AVG(female + male + children + avg_cell_attendance) as attendanceAVG')
                        ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                        ->join('divisions', 'branches.division_id', '=', 'divisions.id')
                        ->whereYear('service_date', $data['year'])
                        ->where('branches.division_id', 'like', '%' . $data['division_id'] . '%')
                        ->groupBy(['service_date', 'division_name'])
                        ->orderBy('service_date')->orderBy('division_name')
                        ->get();
                } else {
                    $res =  BranchReport::selectRaw('service_date, division_name, SUM(female) as female, SUM(male) as male, SUM(children) as children, SUM(avg_cell_attendance) as avg_cell_attendance,
                    SUM(female + male + children + avg_cell_attendance) as totalAttendance,
                    AVG(female + male + children + avg_cell_attendance) as attendanceAVG')
                        ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                        ->join('divisions', 'branches.division_id', '=', 'divisions.id')
                        ->whereYear('service_date', $data['year'])
                        ->where('branches.division_id', 'like', '%' . $data['division_id'] . '%')
                        ->whereMonth('service_date', $data['month'])
                        ->groupBy(['service_date', 'division_name'])
                        ->orderBy('service_date')->orderBy('division_name')
                        ->get();
                }
            } else if ($data['div_zone'] == 'Zone') { //Zone
                if ($data['month'] == '') {
                    $res =  BranchReport::selectRaw('service_date, division_name, z.zone_name, SUM(female) as female, SUM(male) as male, SUM(children) as children, SUM(avg_cell_attendance) as avg_cell_attendance,
                    SUM(female + male + children + avg_cell_attendance) as totalAttendance,
                    AVG(female + male + children + avg_cell_attendance) as attendanceAVG')
                        ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                        ->join('divisions', 'branches.division_id', '=', 'divisions.id')
                        ->join('zones as z', 'branches.zone_id', '=', 'z.id')
                        ->whereYear('service_date', $data['year'])
                        ->where('branches.division_id', 'like', '%' . $data['division_id'] . '%')
                        ->groupBy(['service_date', 'division_name', 'zone_name'])
                        ->orderBy('service_date')->orderBy('division_name')
                        ->get();
                } else {
                    $res =  BranchReport::selectRaw('service_date, division_name, z.zone_name,  SUM(female) as female, SUM(male) as male, SUM(children) as children, SUM(avg_cell_attendance) as avg_cell_attendance,
                    SUM(female + male + children + avg_cell_attendance) as totalAttendance,
                    AVG(female + male + children + avg_cell_attendance) as attendanceAVG')
                        ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                        ->join('divisions', 'branches.division_id', '=', 'divisions.id')
                        ->join('zones as z', 'branches.zone_id', '=', 'z.id')
                        ->whereYear('service_date', $data['year'])
                        ->where('branches.division_id', 'like', '%' . $data['division_id'] . '%')
                        ->whereMonth('service_date', $data['month'])
                        ->groupBy(['service_date', 'division_name', 'zone_name'])
                        ->orderBy('service_date')->orderBy('division_name')
                        ->get();
                }
            } else if ($data['div_zone'] == 'Branch') { //Zone
                if ($data['month'] == '') {
                    $res =  BranchReport::selectRaw('service_date, division_name, br.church_name, SUM(female) as female, SUM(male) as male, SUM(children) as children, SUM(avg_cell_attendance) as avg_cell_attendance,
                    SUM(female + male + children + avg_cell_attendance) as totalAttendance,
                    AVG(female + male + children + avg_cell_attendance) as attendanceAVG')
                        ->join('branches as br', 'branch_reports.branch_id', '=', 'br.id')
                        ->join('divisions', 'br.division_id', '=', 'divisions.id')
                        ->whereYear('service_date', $data['year'])
                        ->where('br.division_id', 'like', '%' . $data['division_id'] . '%')
                        ->groupBy(['service_date', 'division_name', 'church_name'])
                        ->orderBy('service_date')->orderBy('division_name')
                        ->get();
                } else {
                    $res =  BranchReport::selectRaw('service_date, division_name, br.church_name,  SUM(female) as female, SUM(male) as male, SUM(children) as children, SUM(avg_cell_attendance) as avg_cell_attendance,
                    SUM(female + male + children + avg_cell_attendance) as totalAttendance,
                    AVG(female + male + children + avg_cell_attendance) as attendanceAVG')
                        ->join('branches as br', 'branch_reports.branch_id', '=', 'branches.id')
                        ->join('divisions', 'br.division_id', '=', 'divisions.id')
                        ->whereYear('service_date', $data['year'])
                        ->where('br.division_id', 'like', '%' . $data['division_id'] . '%')
                        ->whereMonth('service_date', $data['month'])
                        ->groupBy(['service_date', 'division_name', 'church_name'])
                        ->orderBy('service_date')->orderBy('division_name')
                        ->get();
                }
            }

            return $res;
        } catch (\Exception $exception) {
            Log::error('Attendance report genertion - error: ' . $exception->getMessage());
        }
    }

    //FINANCE
    public function financeReport(Request $request)
    {
        return //$this->RepDataAll($request);
            view('admin.reports.finance-reports', [
                'months' => $this->getMonths(),
                'years' => $this->getReportYear(),
                'select_divzone' => ['Division', 'Zone', 'Branch'],
                'divisions' => $this->getDivisions(),
                'reportdata' => $this->FinanceReportData($request)
            ]);
    }
    public function FinanceReportData(Request $request)
    {
        try {
            $data = $request->validate([
                'div_zone' => 'required',
                'year' => 'required',
                'month' => 'nullable',
                'division_id' => 'nullable',
            ]);


            $res = [];
            if ($data['div_zone'] == 'Division') { //Division 
                if ($data['month'] == '') {
                    $res =  BranchReport::selectRaw("CONCAT(MONTHNAME(service_date), ',' ,YEAR(service_date)) As year, division_name, currency, SUM(tithe) as tithe, 
                        SUM(first_offering) as first_offering, SUM(second_offering) as second_offering, SUM(thanksgiving) as thanksgiving, 
                        SUM(special_offering) as special_offering, SUM(cell_offering) as cell_offering, SUM(amalgamation) as amalgamation,
                        SUM(tithe + first_offering + second_offering + thanksgiving + special_offering) as total_offering")
                        ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                        ->join('divisions', 'branches.division_id', '=', 'divisions.id')
                        ->whereYear('service_date', $data['year'])
                        ->where('branches.division_id', 'like', '%' . $data['division_id'] . '%')
                        ->groupBy(['year', 'division_name', 'currency'])
                        ->orderBy('year', 'desc')->orderBy('division_name')
                        ->get();
                } else {
                    $res =    BranchReport::selectRaw(" CONCAT(MONTHNAME(service_date), ',' ,YEAR(service_date)) As year, division_name, currency,SUM(tithe) as tithe, 
                        SUM(first_offering) as first_offering, SUM(second_offering) as second_offering, SUM(thanksgiving) as thanksgiving, 
                        SUM(special_offering) as special_offering, SUM(cell_offering) as cell_offering, SUM(amalgamation) as amalgamation,
                        SUM(tithe + first_offering + second_offering + thanksgiving + special_offering) as total_offering")
                        ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                        ->join('divisions', 'branches.division_id', '=', 'divisions.id')
                        ->whereYear('service_date', $data['year'])
                        ->whereMonth('service_date', $data['month'])
                        ->where('branches.division_id', 'like', '%' . $data['division_id'] . '%')
                        ->groupBy(['year', 'division_name', 'currency'])
                        ->orderBy('year', 'desc')->orderBy('division_name')
                        ->get();
                }
            } else if ($data['div_zone'] == 'Zone') { //Zone
                if ($data['month'] == '') {
                    $res =  BranchReport::selectRaw("CONCAT(MONTHNAME(service_date), ',' ,YEAR(service_date)) As year, division_name, z.zone_name, currency,  SUM(tithe) as tithe, 
                        SUM(first_offering) as first_offering, SUM(second_offering) as second_offering,  SUM(thanksgiving) as thanksgiving, 
                        SUM(special_offering) as special_offering, SUM(cell_offering) as cell_offering, SUM(amalgamation) as amalgamation,
                        SUM(tithe + first_offering + second_offering + thanksgiving + special_offering) as total_offering")
                        ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                        ->join('divisions', 'branches.division_id', '=', 'divisions.id')
                        ->join('zones as z', 'branches.zone_id', '=', 'z.id')
                        ->whereYear('service_date', $data['year'])
                        ->where('branches.division_id', 'like', '%' . $data['division_id'] . '%')
                        ->groupBy(['year', 'division_name', 'zone_name', 'currency'])
                        ->orderBy('year', 'desc')->orderBy('division_name')
                        ->get();
                } else {
                    $res =  BranchReport::selectRaw("CONCAT(MONTHNAME(service_date), ',' ,YEAR(service_date)) As year, division_name, z.zone_name, currency, SUM(tithe) as tithe, 
                        SUM(first_offering) as first_offering, SUM(second_offering) as second_offering, 
                        SUM(thanksgiving) as thanksgiving, SUM(special_offering) as special_offering, SUM(cell_offering) as cell_offering, SUM(amalgamation) as amalgamation,
                        SUM(tithe + first_offering + second_offering + thanksgiving + special_offering) as total_offering")
                        ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                        ->join('divisions', 'branches.division_id', '=', 'divisions.id')
                        ->join('zones as z', 'branches.zone_id', '=', 'z.id')
                        ->whereYear('service_date', $data['year'])
                        ->where('branches.division_id', 'like', '%' . $data['division_id'] . '%')
                        ->whereMonth('service_date', $data['month'])
                        ->groupBy(['year', 'division_name', 'zone_name', 'currency'])
                        ->orderBy('year', 'desc')->orderBy('division_name')
                        ->get();
                }
            } else if ($data['div_zone'] == 'Branch') { //Zone
                if ($data['month'] == '') {
                    $res =  BranchReport::selectRaw("CONCAT(MONTHNAME(service_date), ',' ,YEAR(service_date)) As year, division_name, br.church_name, currency,  SUM(tithe) as tithe, 
                        SUM(first_offering) as first_offering, SUM(second_offering) as second_offering, 
                        SUM(thanksgiving) as thanksgiving, SUM(special_offering) as special_offering, SUM(cell_offering) as cell_offering, SUM(amalgamation) as amalgamation,
                        SUM(tithe + first_offering + second_offering + thanksgiving + special_offering) as total_offering")
                        ->join('branches as br', 'branch_reports.branch_id', '=', 'br.id')
                        ->join('divisions', 'br.division_id', '=', 'divisions.id')
                        ->whereYear('service_date', $data['year'])
                        ->where('br.division_id', 'like', '%' . $data['division_id'] . '%')
                        ->groupBy(['year', 'division_name', 'church_name', 'currency'])
                        ->orderBy('year', 'desc')->orderBy('division_name')
                        ->get();
                } else {
                    $res =  BranchReport::selectRaw("CONCAT(MONTHNAME(service_date), ',' ,YEAR(service_date)) As year, division_name, br.church_name, currency, SUM(tithe) as tithe, 
                        SUM(first_offering) as first_offering, SUM(second_offering) as second_offering, 
                        SUM(thanksgiving) as thanksgiving, SUM(special_offering) as special_offering, SUM(cell_offering) as cell_offering, SUM(amalgamation) as amalgamation,
                        SUM(tithe + first_offering + second_offering + thanksgiving + special_offering) as total_offering")
                        ->join('branches as br', 'branch_reports.branch_id', '=', 'br.id')
                        ->join('divisions', 'br.division_id', '=', 'divisions.id')
                        ->whereYear('service_date', $data['year'])
                        ->where('br.division_id', 'like', '%' . $data['division_id'] . '%')
                        ->whereMonth('service_date', $data['month'])
                        ->groupBy(['year', 'division_name', 'church_name', 'currency'])
                        ->orderBy('year', 'desc')->orderBy('division_name')
                        ->get();
                }
            }

            return $res;
        } catch (\Exception $exception) {
            Log::error('Finance report genertion - error: ' . $exception->getMessage());
        }
    }


    //BRANCHES
    public function branchesReport(Request $request)
    {
        return
            view('admin.reports.branches-reports', [
                'select_opt' => ['Active', 'Inactive'],
                'divisions' => $this->getDivisions(),
                'reportdata' => $this->BranchesReportData($request)
            ]);
    }
    public function BranchesReportData(Request $request)
    {
        try {
            $data = $request->validate([
                'division_id' => 'nullable',
                'church_status' => 'nullable'
            ]);

            $res =  Branch::select(['branches.*', 'div.division_name', 'div.country', 'z.zone_name'])
                ->join('divisions as div', 'branches.division_id', '=', 'div.id')
                ->join('zones as z', 'branches.zone_id', '=', 'z.id')
                ->where('church_status', 'like', '%' . $data['church_status'] . '%')
                ->where('branches.division_id', 'like', '%' . $data['division_id'] . '%')
                ->orderBy('division_id')->orderBy('church_name')
                ->get();


            return $res;
        } catch (\Exception $exception) {
            Log::error('All report - error: ' . $exception->getMessage());
        }
    }


    //BRANCH REPORTS
    public function branchPropertyReport(Request $request)
    {
        return
            view('admin.reports.branch-property', [
                'select_opt' => ['Submitted', 'Not Sumbitted'],
                'divisions' => $this->getDivisions(),
                'reportdata' => $this->BranchPropertyReportData($request)
            ]);
    }
    public function BranchPropertyReportData(Request $request)
    {
        try {
            $data = $request->validate([
                'division_id' => 'nullable',
                'report_status' => 'required'
            ]);

            if ($data['report_status'] == 'Submitted') {
                $res =  BranchProperty::select(['branch_properties.*', 'br.church_name', 'div.division_name', 'div.country'])
                    ->join('branches as br', 'br.id', '=', 'branch_properties.branch_id')
                    ->join('divisions as div', 'br.division_id', '=', 'div.id')
                    ->where('br.division_id', 'like', '%' . $data['division_id'] . '%')
                    ->orderBy('division_id')->orderBy('church_name')
                    ->get();
            } else {
                $res =  Branch::select(['church_name', 'div.division_name'])
                    ->join('divisions as div', 'branches.division_id', '=', 'div.id')
                    ->whereNotIn('branches.id', function ($q) {
                        $q->select('branch_id')->from('branch_properties');
                    })
                    ->orderBy('division_id')->orderBy('church_name')
                    ->get();
            }

            return $res;
        } catch (\Exception $exception) {
            Log::error('All report - error: ' . $exception->getMessage());
        }
    }


    //Cell reports
    public function lfuReport(Request $request){
        return //$this->RepDataAll($request);
        view('admin.reports.lfu-reports', [
            'months' => $this->getMonths(),
            'years' => $this->getReportYear(),
            'divisions' => $this->getDivisions(),
            'reportdata' => $this->LFUReportAll($request)
        ]);
    }
    protected function LFUReportAll(Request $request)
    {
        try {
            $data = $request->validate([
                'division_id' => 'required',
                'year' => 'required',
                'month' => 'nullable',
                'church_id' => 'nullable'
            ]);


            $res = [];
            if ($data['month'] == '') {
                $res =  BranchReport::select(['cells','cells_met','avg_cell_attendance','cell_offering','service_date',
                    'divisions.division_name', 'branches.church_name', 'branches.currency'])
                    ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                    ->join('divisions', 'branches.division_id', '=', 'divisions.id')                 
                    ->where('branches.division_id', $data['division_id'])
                    ->where('branch_id', 'like', '%' . $data['church_id'] . '%')
                    ->whereYear('service_date', $data['year'])
                    ->orderBy('branch_id')->orderBy('service_date', 'desc')
                    ->get();
            } else {
                $res =  BranchReport::select(['branch_reports.*', 'divisions.division_name', 'branches.church_name', 'branches.currency', 'services.service'])
                    ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                    ->join('divisions', 'branches.division_id', '=', 'divisions.id')
                    ->where('branches.division_id', $data['division_id'])
                    ->where('branch_id', 'like', '%' . $data['church_id'] . '%')
                    ->whereYear('service_date', $data['year'])
                    ->whereMonth('service_date', $data['month'])
                    ->orderBy('branch_id')->orderBy('service_date', 'desc')
                    ->get();
            }

            return $res;
        } catch (\Exception $exception) {
            Log::error('All report - error: ' . $exception->getMessage());
        }
    }


    //ZONE REPORTS

    public function zoneReports(Request $request)
    {
        return
            view('admin.reports.zonal-reports', [
                'months' => $this->getMonths(),
                'years' => $this->getReportYear(),
                'divisions' => $this->getDivisions(),
                'reports' => $this->ZonalReportsData($request)
            ]);
    }
    protected function ZonalReportsData(Request $request)
    {
        try {
            $data = $request->validate([
                'division_id' => 'nullable',
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
                    'records_verified',
                    'dv.division_name'
                )
                    ->join('branches as br', 'zonal_reports.branch_id', '=', 'br.id')
                    ->join('divisions as dv', 'br.division_id', '=', 'dv.id')
                    ->where('br.division_id',  $data['division_id'])
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
                    'records_verified',
                    'dv.division_name'
                )
                    ->join('branches as br', 'zonal_reports.branch_id', '=', 'br.id')
                    ->join('divisions as dv', 'br.division_id', '=', 'dv.id')
                    ->where('br.division_id',  $data['division_id'])
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


   /*  public static function getReportYear()
    {
        return DB::select('select distinct YEAR(service_date) as reportyear from branch_reports');
    }
    public static function getDivisions()
    {
        return Division::orderBy('division_name')->get();
    }
    public static function getMonths()
    {
        return
            collect([
                collect(['month' => 'January', 'monthkey' => 1]),
                collect(['month' => 'February', 'monthkey' => 2]),
                collect(['month' => 'March', 'monthkey' => 3]),
                collect(['month' => 'April', 'monthkey' => 4]),
                collect(['month' => 'May', 'monthkey' => 5]),
                collect(['month' => 'June', 'monthkey' => 6]),
                collect(['month' => 'July', 'monthkey' => 7]),
                collect(['month' => 'August', 'monthkey' => 8]),
                collect(['month' => 'September', 'monthkey' => 9]),
                collect(['month' => 'October', 'monthkey' => 10]),
                collect(['month' => 'November', 'monthkey' => 11]),
                collect(['month' => 'December', 'monthkey' => 12]),
            ]);
    } */





    ///AJAX CALLS////
    public function ajaxBranches(Request $request)
    {
        $data = $request->validate(['division_id' => 'required']);
        $branch = Branch::select('church_name', 'id')
            ->where('division_id', $data['division_id'])
            ->orderBy('church_name')->get();

        return response()->json([
            'status' => true,
            'message' => "successfull",
            'branches' => $branch
        ]);
    }
}
