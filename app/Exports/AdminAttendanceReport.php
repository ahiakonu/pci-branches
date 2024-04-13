<?php

namespace App\Exports;

use App\Models\BranchReport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AdminAttendanceReport implements FromCollection, WithHeadings, WithStyles
{
    protected $year = '';
    protected $month = '';
    protected $div_id = '';
    protected $div_zone = '';
    public function __construct(int $year, int $month, string $div_id, string $div_zone)
    {
        $this->year = $year;
        $this->month = $month;
        $this->div_id = $div_id;
        $this->div_zone = $div_zone;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        Log::info('attendance report');
        try {
            if ($this->div_zone == 'Division') { //Division 
                if ($this->month == 0) {
                    $res =  BranchReport::selectRaw('service_date, division_name, SUM(female) as female, SUM(male) as male, SUM(children) as children, SUM(avg_cell_attendance) as avg_cell_attendance, 
                SUM(female + male + children + avg_cell_attendance) as totalAttendance,
                AVG(female + male + children + avg_cell_attendance) as attendanceAVG')
                        ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                        ->join('divisions', 'branches.division_id', '=', 'divisions.id')
                        ->whereYear('service_date', $this->year)
                        ->where('branches.division_id', 'like', '%' . $this->div_id . '%')
                        ->groupBy(['service_date', 'division_name'])
                        ->orderBy('service_date')->orderBy('division_name')
                        ->get();
                } else {
                    $res =  BranchReport::selectRaw('service_date, division_name, SUM(female) as female, SUM(male) as male, SUM(children) as children, SUM(avg_cell_attendance) as avg_cell_attendance,
                SUM(female + male + children + avg_cell_attendance) as totalAttendance,
                AVG(female + male + children + avg_cell_attendance) as attendanceAVG')
                        ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                        ->join('divisions', 'branches.division_id', '=', 'divisions.id')
                        ->whereYear('service_date', $this->year)
                        ->where('branches.division_id', 'like', '%' . $this->div_id . '%')
                        ->whereMonth('service_date', $this->month)
                        ->groupBy(['service_date', 'division_name'])
                        ->orderBy('service_date')->orderBy('division_name')
                        ->get();
                }
            } elseif ($this->div_zone  == 'Zone') { //Zone
                if ($this->month == 0) {
                    $res =  BranchReport::selectRaw('service_date, division_name, z.zone_name, SUM(female) as female, SUM(male) as male, SUM(children) as children, SUM(avg_cell_attendance) as avg_cell_attendance,
                SUM(female + male + children + avg_cell_attendance) as totalAttendance,
                AVG(female + male + children + avg_cell_attendance) as attendanceAVG')
                        ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                        ->join('divisions', 'branches.division_id', '=', 'divisions.id')
                        ->join('zones as z', 'branches.zone_id', '=', 'z.id')
                        ->whereYear('service_date', $this->year)
                        ->where('branches.division_id', 'like', '%' . $this->div_id . '%')
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
                        ->whereYear('service_date', $this->year)
                        ->where('branches.division_id', 'like', '%' . $this->div_id . '%')
                        ->whereMonth('service_date', $this->month)
                        ->groupBy(['service_date', 'division_name', 'zone_name'])
                        ->orderBy('service_date')->orderBy('division_name')
                        ->get();
                }
            } else if ($this->div_zone == 'Branch') { //Zone
                if ($this->month == 0) {
                    $res =  BranchReport::selectRaw('service_date, division_name, br.church_name, SUM(female) as female, SUM(male) as male, SUM(children) as children, SUM(avg_cell_attendance) as avg_cell_attendance,
                    SUM(female + male + children + avg_cell_attendance) as totalAttendance,
                    AVG(female + male + children + avg_cell_attendance) as attendanceAVG')
                        ->join('branches as br', 'branch_reports.branch_id', '=', 'br.id')
                        ->join('divisions', 'br.division_id', '=', 'divisions.id')
                        ->whereYear('service_date', $this->year)
                        ->where('br.division_id', 'like', '%' . $this->div_id  . '%')
                        ->groupBy(['service_date', 'division_name', 'church_name'])
                        ->orderBy('service_date')->orderBy('division_name')
                        ->get();
                } else {
                    $res =  BranchReport::selectRaw('service_date, division_name, br.church_name,  SUM(female) as female, SUM(male) as male, SUM(children) as children, SUM(avg_cell_attendance) as avg_cell_attendance,
                    SUM(female + male + children + avg_cell_attendance) as totalAttendance,
                    AVG(female + male + children + avg_cell_attendance) as attendanceAVG')
                        ->join('branches as br', 'branch_reports.branch_id', '=', 'branches.id')
                        ->join('divisions', 'br.division_id', '=', 'divisions.id')
                        ->whereYear('service_date',  $this->year)
                        ->where('br.division_id', 'like', '%' . $this->div_id . '%')
                        ->whereMonth('service_date', $this->month)
                        ->groupBy(['service_date', 'division_name', 'church_name'])
                        ->orderBy('service_date')->orderBy('division_name')
                        ->get();
                }
            }


            return $res;
        } catch (\Exception $exception) {

            Log::error('error: report attendance' . $exception->getMessage());
            return back()->with(['errormessage' => $exception->getMessage()]);
        }
    }

    public function headings(): array
    {
        $headingArray = [];
        if ($this->div_zone == 'Division') {
            $headingArray = ['Service Date', 'Division', 'Female', 'Male', 'Children', 'Avg Cell Attd', 'Total Attd', 'Avg Attd'];
        } else if ($this->div_zone == 'Zone') {
            $headingArray = ['Service Date', 'Division', 'Zone', 'Female', 'Male', 'Children', 'Avg Cell Attd', 'Total Attd', 'Avg Attd'];
        } else if ($this->div_zone == 'Branch') {
            $headingArray = ['Service Date', 'Division', 'Branch', 'Female', 'Male', 'Children', 'Avg Cell Attd', 'Total Attd', 'Avg Attd'];
        }
        return $headingArray;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true, 'size' => 14]],
        ];
    }
}
