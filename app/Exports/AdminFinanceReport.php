<?php

namespace App\Exports;

use App\Models\BranchReport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AdminFinanceReport implements FromCollection, WithHeadings, WithStyles
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
         

        Log::info('finance report' . $this->div_zone);
        try {
            if ($this->div_zone == 'Division') { //Division 
                if ($this->month == 0) {
                    $res =  BranchReport::selectRaw("CONCAT(MONTHNAME(service_date), ',' ,YEAR(service_date)) As year, division_name, currency, SUM(tithe) as tithe, 
                        SUM(first_offering) as first_offering, SUM(second_offering) as second_offering, SUM(thanksgiving) as thanksgiving, 
                        SUM(special_offering) as special_offering, SUM(cell_offering) as cell_offering, SUM(amalgamation) as amalgamation,
                        SUM(tithe + first_offering + second_offering + thanksgiving + special_offering) as total_offering")
                        ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                        ->join('divisions', 'branches.division_id', '=', 'divisions.id')
                        ->whereYear('service_date', $this->year)
                        ->where('branches.division_id', 'like', '%' . $this->div_id . '%')
                        ->groupBy(['year', 'division_name','currency'])
                        ->orderBy('year', 'desc')->orderBy('division_name')
                        ->get();
                } else {
                    $res =    BranchReport::selectRaw(" CONCAT(MONTHNAME(service_date), ',' ,YEAR(service_date)) As year, division_name, currency,SUM(tithe) as tithe, 
                        SUM(first_offering) as first_offering, SUM(second_offering) as second_offering, SUM(thanksgiving) as thanksgiving, 
                        SUM(special_offering) as special_offering, SUM(cell_offering) as cell_offering, SUM(amalgamation) as amalgamation,
                        SUM(tithe + first_offering + second_offering + thanksgiving + special_offering) as total_offering")
                        ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                        ->join('divisions', 'branches.division_id', '=', 'divisions.id')
                        ->whereYear('service_date', $this->year)
                        ->whereMonth('service_date', $this->month)
                        ->where('branches.division_id', 'like', '%' . $this->div_id . '%')
                        ->groupBy(['year', 'division_name','currency'])
                        ->orderBy('year', 'desc')->orderBy('division_name')
                        ->get();
                }
            } else if ($this->div_zone  == 'Zone') { //Zone
                if ($this->month == 0) {
                    $res =  BranchReport::selectRaw("CONCAT(MONTHNAME(service_date), ',' ,YEAR(service_date)) As year, division_name, z.zone_name, currency,  SUM(tithe) as tithe, 
                        SUM(first_offering) as first_offering, SUM(second_offering) as second_offering,  SUM(thanksgiving) as thanksgiving, 
                        SUM(special_offering) as special_offering, SUM(cell_offering) as cell_offering, SUM(amalgamation) as amalgamation,
                        SUM(tithe + first_offering + second_offering + thanksgiving + special_offering) as total_offering")
                        ->join('branches', 'branch_reports.branch_id', '=', 'branches.id')
                        ->join('divisions', 'branches.division_id', '=', 'divisions.id')
                        ->join('zones as z', 'branches.zone_id', '=', 'z.id')
                        ->whereYear('service_date', $this->year)
                        ->where('branches.division_id', 'like', '%' . $this->div_id . '%')
                        ->groupBy(['year', 'division_name', 'zone_name','currency'])
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
                        ->whereYear('service_date', $this->year)
                        ->where('branches.division_id', 'like', '%' . $this->div_id . '%')
                        ->whereMonth('service_date', $this->month)
                        ->groupBy(['year', 'division_name', 'zone_name','currency'])
                        ->orderBy('year', 'desc')->orderBy('division_name')
                        ->get();
                }
            } else if ($this->div_zone == 'Branch') { //Zone
                if ($this->month == 0) {
                    $res =  BranchReport::selectRaw("CONCAT(MONTHNAME(service_date), ',' ,YEAR(service_date)) As year, division_name, br.church_name, currency,  SUM(tithe) as tithe, 
                        SUM(first_offering) as first_offering, SUM(second_offering) as second_offering, 
                        SUM(thanksgiving) as thanksgiving, SUM(special_offering) as special_offering, SUM(cell_offering) as cell_offering, SUM(amalgamation) as amalgamation,
                        SUM(tithe + first_offering + second_offering + thanksgiving + special_offering) as total_offering")
                        ->join('branches as br', 'branch_reports.branch_id', '=', 'br.id')
                        ->join('divisions', 'br.division_id', '=', 'divisions.id')
                        ->whereYear('service_date', $this->year)
                        ->where('br.division_id', 'like', '%' . $this->div_id. '%')
                        ->groupBy(['year', 'division_name', 'church_name','currency'])
                        ->orderBy('year', 'desc')->orderBy('division_name')
                        ->get();
                } else {
                    $res =  BranchReport::selectRaw("CONCAT(MONTHNAME(service_date), ',' ,YEAR(service_date)) As year, division_name, br.church_name, currency, SUM(tithe) as tithe, 
                        SUM(first_offering) as first_offering, SUM(second_offering) as second_offering, 
                        SUM(thanksgiving) as thanksgiving, SUM(special_offering) as special_offering, SUM(cell_offering) as cell_offering, SUM(amalgamation) as amalgamation,
                        SUM(tithe + first_offering + second_offering + thanksgiving + special_offering) as total_offering")
                        ->join('branches as br', 'branch_reports.branch_id', '=', 'br.id')
                        ->join('divisions', 'br.division_id', '=', 'divisions.id')
                        ->whereYear('service_date', $this->year)
                        ->where('br.division_id', 'like', '%' . $this->div_id. '%')
                        ->whereMonth('service_date', $this->month)
                        ->groupBy(['year', 'division_name', 'church_name','currency'])
                        ->orderBy('year', 'desc')->orderBy('division_name')
                        ->get();
                }
            }


            return $res;
        } catch (\Exception $exception) {

            Log::error('error: report finance' . $exception->getMessage());
            return back()->with(['errormessage' => $exception->getMessage()]);
        }
    }

    public function headings(): array
    {
        $headingArray = [];
        if ($this->div_zone == 'Division') {
            $headingArray = ['Period', 'Division', 'Curr', 'Tithe', '1st Off', '2nd Off', 'Thanksgiving', 'Special Off', 'Cell Off','Amalgamation','Total Off'];
        } else if ($this->div_zone == 'Zone') {
            $headingArray = ['Period', 'Division', 'Zone', 'Curr', 'Tithe', '1st Off', '2nd Off', 'Thanksgiving', 'Special Off', 'Cell Off','Amalgamation','Total Off'];
        } else if ($this->div_zone == 'Branch') {
            $headingArray = ['Period', 'Division', 'Branch', 'Curr', 'Tithe', '1st Off', '2nd Off', 'Thanksgiving', 'Special Off', 'Cell Off','Amalgamation','Total Off'];
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
