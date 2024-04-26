<?php

namespace App\Http\Controllers;

use App\Exports\DivisionalBranchReportsAllExport;
use App\Http\Traits\GlobalValuesCore;
use App\Models\Branch;
use App\Models\BranchReport;
use App\Models\Service;
use App\Models\ZonalReport;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class DivisionalReportController extends Controller
{
    use GlobalValuesCore;

    protected function div_id()
    {
        return auth()->user()->user_role_id;
    }

    public function divisionalIndex()
    {

        return view(
            'dashboard-divisional',
            [
                'dash' => [], //$this->branchDashboard(),
                'branch_count' => Branch::where('division_id', $this->div_id())->count(),
                'branch_reports_count' => BranchReport::join('branches as br', 'branch_reports.branch_id', '=', 'br.id')
                    ->where('br.division_id', $this->div_id())->whereYear('service_date', now()->year)->count(), //$this->zoneBranches(),
                'zone_count' => Zone::where('division_id', $this->div_id())->count(),
                'zonal_report_count' => ZonalReport::join('zones as zn', 'zonal_reports.zone_id', '=', 'zn.id')
                    ->where('zn.division_id', $this->div_id())->where('report_year', now()->year)->count(),
                'branches' => [],
                'zones' => $this->zonesSnapShort(),
                'zonereports' => []//$this->topZoneReports()
            ]
        );
    }


    protected function zonesSnapShort()
    {
        return Zone::select(
            'zone_name',
            'zonal_leader',

            'id',
            DB::raw('(select sum(attendance) from branch_targets inner join branches as br on br.id = branch_targets.branch_id where br.zone_id=zones.id ) as attendaceTarget'),
            DB::raw('(select sum(income) from branch_targets inner join branches as br on br.id = branch_targets.branch_id where br.zone_id=zones.id ) as incomeTarget'),
            DB::raw('(select count(*) from zonal_reports where report_year =' . now()->year . ' and zone_id=zones.id) as reports')
        )
            ->where('division_id', $this->div_id())

            ->get();
    }


    protected function divisionZones()
    {
        return Zone::select('zone_name', 'id',)
            ->where('division_id', $this->div_id())->get();
    }

    public function zoneReports(Request $request)
    {
        return view(
            'divisional.div-zone-reports',
            [
                'reports' =>  $this->zoneReportsData($request),
                'zones' => $this->divisionZones(),
                'years' => $this->getReportYear(),
                'months' => $this->getMonths()
            ]
        );
    }

    protected function zoneReportsData(Request $request)
    {
        try {

            $data = $request->validate([
                'zone' => 'nullable',
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
                    'zn.zone_name',
                    'zn.id as zone_id',
                )
                    ->join('branches as br', 'zonal_reports.branch_id', '=', 'br.id')
                    ->join('zones as zn', 'zonal_reports.zone_id', '=', 'zn.id')
                    //->where('br.division_id',  $this->div_id())
                    ->where('zonal_reports.zone_id',  $data['zone'])
                    ->where('report_year', $data['year'])
                    ->orderBy('church_name')->orderBy('month_key', 'desc')
                    ->get(); //
            } else {
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
                    'zn.zone_name',
                    'zn.id as zone_id',
                )
                    ->join('branches as br', 'zonal_reports.branch_id', '=', 'br.id')
                    ->join('zones as zn', 'zonal_reports.zone_id', '=', 'zn.id')
                    //->where('br.division_id',  $this->div_id())
                    ->where('zonal_reports.zone_id',  $data['zone'])
                    ->where('report_year', $data['year'])->where('month_key', $data['month'])
                    ->orderBy('church_name')->orderBy('month_key', 'desc')
                    ->get(); //




            }
            //


            return $res;
        } catch (\Exception $exception) {
            Log::error('  - error: ' . $exception->getMessage());
        }
    }


    public function branchReportDetails(Request $request)
    {
        return view(
            'divisional.div-branch-reports-details',
            [
                'reportdata' =>  $this->BranchesReportData($request),
                'zones' => $this->divisionZones(),
                'years' => $this->getReportYear(),
                'months' => $this->getMonths()
            ]
        );
    }
    protected function BranchesReportData(Request $request)
    {
        try {
            $data = $request->validate([
                'zone' => 'required',
                'year' => 'required',
                'month' => 'nullable',
            ]);


            $res = [];
            if ($data['month'] == '') {
                $res =  BranchReport::select(['branch_reports.*', 'zones.zone_name', 'branches.church_name', 'branches.currency', 'services.service'])
                    ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                    ->join('zones', 'branches.zone_id', '=', 'zones.id')
                    ->join('services', 'branch_reports.service_id', '=', 'services.id')
                    ->where('branches.zone_id', $data['zone'])
                    ->whereYear('service_date', $data['year'])
                    ->orderBy('church_name')->orderBy('service_date', 'desc')
                    ->get();
            } else {
                
                $res =  BranchReport::select(['branch_reports.*', 'zones.zone_name', 'branches.church_name', 'branches.currency', 'services.service'])
                ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                ->join('zones', 'branches.zone_id', '=', 'zones.id')
                ->join('services', 'branch_reports.service_id', '=', 'services.id')
                ->where('branches.zone_id', $data['zone'])
                ->whereYear('service_date', $data['year'])
                ->whereMonth('service_date', $data['month'])
                ->orderBy('church_name')->orderBy('service_date', 'desc')
                ->get();

               
            }

            return $res;
        } catch (\Exception $exception) {
            Log::error('All report - error: ' . $exception->getMessage());
        }
    }

    public function branchReportDetailsEdit(string $id)
    {
        return view(
            'divisional.div-branch-report-edit',
            [
                'services' => Service::all(),
                'report' => BranchReport::findOrFail($id)
            ]
        );
    }


    public function exportBranchReports(Request $request)
    {
     
        $data = $request->all();

        $montt = $data['down_month'] == '' ? 0 : intval($data['down_month']);
        return Excel::download(new DivisionalBranchReportsAllExport(intval($data['down_year']), $montt, $data['down_zone'],), 'myzonal-report-all-' . $data['down_year'] . '.xlsx');
    }





      //BRANCHES
      public function branchesReport(Request $request)
      {
          return
              view('divisional.div-branches-list', [
                  'select_opt' => ['Active', 'Inactive'],
                  'zones' => $this->divisionZones(),
                  'reportdata' => $this->DivisionBranchesData($request)
              ]);
      }
      protected function DivisionBranchesData(Request $request)
      {
          try {
              $data = $request->validate([
                  'zone' => 'nullable',
                  'church_status' => 'nullable'
              ]);
  
              $res =  Branch::select(['branches.*', 'div.division_name', 'div.country', 'z.zone_name'])
                  ->join('divisions as div', 'branches.division_id', '=', 'div.id')
                  ->join('zones as z', 'branches.zone_id', '=', 'z.id')
                  ->where('church_status', 'like', '%' . $data['church_status'] . '%')
                  ->where('branches.zone_id', 'like', '%' . $data['zone'] . '%')
                  ->where('branches.division_id',$this->div_id())
                  ->orderBy('division_id')->orderBy('church_name')
                  ->get();
  
  
              return $res;
          } catch (\Exception $exception) {
              Log::error('All report - error: ' . $exception->getMessage());
          }
      }
}
