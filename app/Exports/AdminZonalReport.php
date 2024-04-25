<?php

namespace App\Exports;

use App\Models\Branch;
use App\Models\ZonalReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\Log;

class AdminZonalReport implements FromCollection, WithHeadings, WithStyles
{

    protected $year = '';
    protected $month = '';
    protected $div_id = '';

    public function __construct(int $year, int $month, string $div_id)
    {
        $this->year = $year;
        $this->month = $month;
        $this->div_id = $div_id;
    }

    public function collection()
    {
        Log::info('branch report- all');
        try {
            if ($this->month  == 0) {
                $res = ZonalReport::select(
                    'zonal_reports.created_at',
                    'dv.division_name',
                    'br.church_name',
                    'report_year',
                    'report_month',
                    'branch_visited',
                    'pastor_follow_teaching',
                    'total_tithe',
                    'total_first_offering',
                    'amalgamation_paid',
                    'check_amalgamation',
                    'algamation_correct',
                    'attendance_inc_dec',
                    'attendance_verified',
                    'records_verified',
                    'pastor_corporate',
                    'zonal_comments'
                )
                    ->join('branches as br', 'zonal_reports.branch_id', '=', 'br.id')
                    ->join('divisions as dv', 'br.division_id', '=', 'dv.id')
                    ->where('br.division_id',  $this->div_id)
                    ->where('report_year', $this->year)
                    ->orderBy('church_name')->orderBy('month_key', 'desc')
                    ->get(); //
            } else {
                $res =   ZonalReport::select(
                    'zonal_reports.created_at',
                    'dv.division_name',
                    'br.church_name',
                    'report_year',
                    'report_month',
                    'branch_visited',
                    'pastor_follow_teaching',
                    'total_tithe',
                    'total_first_offering',
                    'amalgamation_paid',
                    'check_amalgamation',
                    'algamation_correct',
                    'attendance_inc_dec',
                    'attendance_verified',
                    'records_verified',
                    'pastor_corporate',
                    'zonal_comments'
                )
                    ->join('branches as br', 'zonal_reports.branch_id', '=', 'br.id')
                    ->join('divisions as dv', 'br.division_id', '=', 'dv.id')
                    ->where('br.division_id',  $this->div_id)
                    ->where('report_year', $this->year)
                    ->where('month_key', $this->month)
                    ->orderBy('church_name')->orderBy('month_key', 'desc')
                    ->get(); //
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
            'report_date',
            'division_name',
            'branch',
            'report_year',
            'report_month',
            'branch_visited',
            'pastor_follow_teaching',
            'total_tithe',
            'total_first_offering',
            'amalgamation_paid',
            'check_amalgamation',
            'algamation_correct',
            'attendance_inc_dec',
            'attendance_verified',
            'records_verified',
            'pastor_corporate',
            'zonal_comments'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true, 'size' => 14]],
        ];
    }
}
