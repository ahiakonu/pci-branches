<?php

namespace App\Exports;

use App\Models\BranchReport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BranchReportsExport implements FromCollection, WithHeadings, WithStyles
{


    protected $year = '';
    protected $month = '';
    protected $branch_id = '';
    public function __construct(int $year, int $month, string $branch_id = '')
    {
        $this->year = $year;
        $this->month = $month;
        $this->branch_id = $branch_id;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        Log::info('branch report- all');
        try {
            if ($this->month  == 0) {
                $res =  BranchReport::query()
                    ->select([
                        'services.service',
                        'service_date',
                        'name_of_preacher',
                        'theme_and_sermon',
                        'amalgamation',
                        'amalgamation_paid',
                        'tithe',
                        'first_offering',
                        'second_offering',
                        'thanksgiving',
                        'special_offering',
                        'other_donations_cash_or_kind',
                        'female',
                        'male',
                        'children',
                        'visitors',
                        'souls_won',
                        'water_baptised',
                        'holy_ghost_baptised',
                        'people_inducted',
                        'weddings',
                        'births',
                        'children_named',
                        'children_dedicated',
                        'deaths',
                        'special_programs_in_week',
                        'issues_or_comments',
                        'report_by',
                        'cells',
                        'cells_met',
                        'avg_cell_attendance',
                        'cell_offering'
                    ])
                    ->join('services', 'branch_reports.service_id', '=', 'services.id')
                    ->where('branch_id', 'like', '%' . $this->branch_id . '%')
                    ->whereYear('service_date', $this->year)
                    ->orderBy('branch_id')->orderBy('service_date', 'desc')
                    ->get();
            } else {
                $res =   BranchReport::query()
                    ->select([
                       
                        'service_date',
                        'name_of_preacher',
                        'theme_and_sermon',
                        'amalgamation',
                        'amalgamation_paid',
                        'tithe',
                        'first_offering',
                        'second_offering',
                        'thanksgiving',
                        'special_offering',
                        'other_donations_cash_or_kind',
                        'female',
                        'male',
                        'children',
                        'visitors',
                        'souls_won',
                        'water_baptised',
                        'holy_ghost_baptised',
                        'people_inducted',
                        'weddings',
                        'births',
                        'children_named',
                        'children_dedicated',
                        'deaths',
                        'special_programs_in_week',
                        'issues_or_comments',
                        'report_by',
                        'cells',
                        'cells_met',
                        'avg_cell_attendance',
                        'cell_offering'
                    ])
                    ->join('services', 'branch_reports.service_id', '=', 'services.id')
                    ->where('branch_id', 'like', '%' . $this->branch_id . '%')
                    ->whereYear('service_date', $this->year)
                    ->whereMonth('service_date', $this->month)
                    ->orderBy('branch_id')->orderBy('service_date', 'desc')
                    ->get();
            }
            return $res;
        } catch (\Exception $exception) {

            Log::error('error: report gen' . $exception->getMessage());
            return back()->with(['errormessage' => $exception->getMessage()]);
        }
    }


    public function headings(): array
    {
        return [
            'Service',
            //'branch_id',
            'service_date',
            //'service_id',
            'name_of_preacher',
            'theme_and_sermon',
            'amalgamation',
            'amalgamation_paid',
            'tithe',
            'first_offering',
            'second_offering',
            'thanksgiving',
            'special_offering',
            'other_donations_cash_or_kind',
            'female',
            'male',
            'children',
            'visitors',
            'souls_won',
            'water_baptised',
            'holy_ghost_baptised',
            'people_inducted',
            'weddings',
            'births',
            'children_named',
            'children_dedicated',
            'deaths',
            'special_programs_in_week',
            'issues_or_comments',
            'report_by',
            'cells',
            'cells_met',
            'avg_cell_attendance',
            'cell_offering'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true, 'size' => 14]],
        ];
    }
}
