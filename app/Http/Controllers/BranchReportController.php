<?php

namespace App\Http\Controllers;

use App\Exports\BranchReportsExport;
use App\Http\Traits\GlobalValuesCore;
use App\Models\Branch;
use App\Models\BranchReport;
use App\Models\NoticeBoard;
use App\Models\Service;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class BranchReportController extends Controller
{
    use GlobalValuesCore;

    public $selectedindex = 0;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view(
            'branch.services.br-service-index',
            [
                'reports' => $this->BranchReportDataAll($request),
                'branch' => $this->getBranchInfo(),
                'months' => $this->getMonths(),
                'years' => $this->getReportYear(),

            ]
        );
    }


    protected function BranchReportDataAll(Request $request)
    {
        try {
            $data = $request->validate([
                'year' => 'required',
                'month' => 'nullable'
            ]);
 Log::info($data);
            $year = $data['year'] ??  now()->year;
            $month = $data['month'] ??  now()->month;

            $res = [];
            if ($data['month'] == '') {
                $res =  BranchReport::where('branch_id', $this->branchID())
                    ->whereYear('service_date', $year)
                    ->orderBy('service_date', 'desc')
                    ->get();
            } else {
                $res =  BranchReport::where('branch_id', $this->branchID())
                    ->whereYear('service_date', $year)
                    ->whereMonth('service_date', $month)
                    ->orderBy('branch_id')->orderBy('service_date', 'desc')
                    ->get();
            }

            return $res;
        } catch (\Exception $exception) {
            Log::error('All report - error: ' . $exception->getMessage());
        }
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'branch.services.br-service-create',
            [
                'services' => Service::all(),
                'branch' => $this->getBranchInfo()
            ]
        );
    }

    protected function getBranchInfo()
    {
        return Branch::findOrFail(auth()->user()->user_role_id);
    }
    protected function branchID()
    {
        return auth()->user()->user_role_id;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $attributes = $this->FormValidation($request);

            if ($attributes['male'] + $attributes['female'] <= 0) {
                throw ValidationException::withMessages(['errrormessage' => 'Total male + female attendance must be more than 0(zero). Process abored!']);
            }

            $sdate = (Carbon::parse($attributes['service_date'])->format('Y-m-d'));
            if (DB::table('branch_reports')
                ->where('service_id', $attributes['service_id'])
                ->where('service_date', $sdate)
                ->where('branch_id', $attributes['branch_id'])
                ->exists()
            ) {
                throw ValidationException::withMessages(['errrormessage' => 'Report for selected service and date already in the system. Process abored!']);
            }

            BranchReport::create($attributes);
            return back()->with(['success' => 'Report saved successfully !']);
        } catch (Exception $ex) {
            Log::info('error - branch report ::' . $ex);
            throw ValidationException::withMessages(['errrormessage' => $ex]);
        }
    }

    //FORM VALIDATION
    protected function FormValidation(Request $request): array //defalut is null, ? indeciates its optopnal
    {
        return  $request->validate([
            'branch_id' => ['required', Rule::exists('branches', 'id')],
            'service_date' => ['required', 'date', 'before:tomorrow'],
            'service_id' => ['required'],
            'name_of_preacher' => 'required',
            'theme_and_sermon' => 'required',
            //'amalgamation' => 'required|numeric|min:0',
            //'amalgamation_paid' => 'required|numeric|min:0',
            'tithe' => 'required|numeric|min:0',
            'first_offering' => 'required|numeric|min:0',
            'second_offering' => 'required|numeric|min:0',
            'thanksgiving' => 'required|numeric|min:0',
            'special_offering' => 'required|numeric|min:0',
            'other_donations_cash_or_kind' => 'nullable',
            'female' =>   'required|numeric|min:0',
            'male' =>     'required|numeric|min:0',
            'children' => 'required|numeric|min:0',
            'visitors' => 'required|numeric|min:0',
            'souls_won' => 'required|numeric|min:0',
            'water_baptised' => 'required|numeric|min:0',
            'holy_ghost_baptised' => 'required|numeric|min:0',
            'people_inducted' => 'required|numeric|min:0',
            'weddings' => 'required|numeric|min:0',
            'births' => 'required|numeric|min:0',
            'children_named' => 'required|numeric|min:0',
            'children_dedicated' => 'required|numeric|min:0',
            'deaths' => 'required|numeric|min:0',
            'special_programs_in_week' => 'nullable',
            'issues_or_comments' => 'nullable',
            'report_by' => 'required',
            'cells' => 'required|numeric|min:0',
            'cells_met' => 'required|numeric|min:0',
            'avg_cell_attendance' => 'required|numeric|min:0',
            'cell_offering' => 'required|numeric|min:0',
        ]);
    }

    public function show(BranchReport $branchreport)
    {

        return view(
            'branch.services.br-service-show',
            [
                'services' => Service::all(),
                'report' => $branchreport //BranchReport::findOrFail($id)
            ]
        );
    }
    /**
     * Display the specified resource.
     */
    public function adminShow(BranchReport $branchreport)
    {
        return view(
            'branch.services.br-service-show',
            [
                'services' => Service::all(),
                'report' => $branchreport //BranchReport::findOrFail($id)
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function adminEdit(string $id)
    {

        return view(
            'branch.services.br-service-edit',
            [
                'services' => Service::all(),
                'report' => BranchReport::findOrFail($id)
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function adminUpdate(Request $request, string $id)
    {
        try {
            $attributes = $this->FormValidation($request);
            $att_ = $request->validate(
                ['reason_for_edit' => 'required']
            );
            $branchReport = BranchReport::findOrFail($id);
            if ($attributes['male'] + $attributes['female'] <= 0) {
                throw ValidationException::withMessages(['errrormessage' => 'Total male + female attendance must be more than 0(zero). Process abored!']);
            }

            $sdate = (Carbon::parse($attributes['service_date'])->format('Y-m-d'));
            if (DB::table('branch_reports')
                ->where('service_id', $attributes['service_id'])
                ->where('service_date', $sdate)
                ->where('branch_id', $attributes['branch_id'])
                ->where('id', '<>', $id)
                ->exists()
            ) {
                throw ValidationException::withMessages(['errrormessage' => 'Report for selected service and date already in the system. Process abored!']);
            }
            $branchReport->update($attributes);

            NoticeBoard::create(
                [
                    'sender' => auth()->user()->name,
                    'sender_role' =>  ucwords(strtolower(str_replace('_', ' ', auth()->user()->user_role))),
                    'sender_id' => auth()->user()->id,
                    'receiptient' => $branchReport->branch->church_name,
                    'receiptient_role' => 'Branch Pastor',
                    'receiptient_id' => $branchReport->branch_id,
                    'message_title' => 'Branch Report Update',
                    'message_body' => $att_['reason_for_edit'],
                    'status' => 'Initial'
                ]
            );

            return back()->with('success', 'Branch Report Updated!');
        } catch (Exception $ex) {
            throw ValidationException::withMessages(['errrormessage' => $ex]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BranchReport $branchReport)
    {
        //
    }



    public function reportAnalysis()
    {
        return view('branch.services.br-reports-analysis');
    }

    public function exportBranchReports(Request $request)
    {
        Log::info('branch reports-all generated');
        $data = $request->all();

        $montt = $data['down_month'] == '' ? 0 : intval($data['down_month']);
        return Excel::download(new BranchReportsExport(intval($data['down_year']), $montt,  $this->branchID()), 'report-all-' . $data['down_year'] . '.xlsx');
    }
}
