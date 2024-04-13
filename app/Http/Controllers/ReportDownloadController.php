<?php

namespace App\Http\Controllers;

use App\Exports\AdminAttendanceReport;
use App\Exports\AdminBranchesReport;
use App\Exports\AdminBranchPropertyReport;
use App\Exports\AdminBranchReportsAllExport;
use App\Exports\AdminFinanceReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReportDownloadController extends Controller
{
    //Reports 
    public function exportBranchReports(Request $request)
    {
        Log::info('reports-all generated');
        $data = $request->all();

        $montt = $data['down_month'] == '' ? 0 : intval($data['down_month']);
        return Excel::download(new AdminBranchReportsAllExport(intval($data['down_year']), $montt, $data['down_division'], $data['down_church'].''), 'report-all-' . $data['down_year'] . '.xlsx');
    }


    public function exportAttendanceReport(Request $request)
    {
        Log::info('reports-attendance generated');
        $data = $request->all();
        $div = $data['down_division'] == '' ? '' : $data['down_division'];
        $montt = $data['down_month'] == '' ? 0 : intval($data['down_month']);
        return Excel::download(new AdminAttendanceReport(intval($data['down_year']), $montt, $div, $data['down_divzone']), 'attendance.xlsx');
    }

    public function exportFinanceReport(Request $request)
    {
        Log::info('reports-finance generated');
        $data = $request->all();
        $div = $data['down_division'] == '' ? '' : $data['down_division'];
        $montt = $data['down_month'] == '' ? 0 : intval($data['down_month']);
        return Excel::download(new AdminFinanceReport(intval($data['down_year']), $montt, $div, $data['down_divzone']), 'finance-' . $data['down_year'] . '.xlsx');
    }

    public function exportBranchesReport(Request $request)
    {
        Log::info('reports-branches generated');
        $data = $request->all();
        $div_id = $data['down_division'] == '' ? '' : $data['down_division'];
        $status = $data['down_church_status'] == '' ? '' : $data['down_church_status'];
       
        return Excel::download(new AdminBranchesReport($div_id,$status), 'branches-' . $status. '.xlsx');
    }


    public function exportBranchPropertyReport(Request $request)
    {
        Log::info('reports-branch property generated');
        $data = $request->all();
        $div_id = $data['down_division'] == '' ? '' : $data['down_division'];
        $status = $data['down_church_status'] == '' ? '' : $data['down_church_status'];
       
        return Excel::download(new AdminBranchPropertyReport($div_id,$status), 'branches-property' . $status. '.xlsx');
    }
}
