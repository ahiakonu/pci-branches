<?php

namespace App\Exports;

use App\Models\Branch;
use App\Models\BranchProperty;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AdminBranchPropertyReport implements FromCollection, WithHeadings, WithStyles
{
    protected $division_id = '';
    protected $church_status = '';
    public function __construct(string $division_id, string $church_status)
    {
        $this->division_id = $division_id;
        $this->church_status = $church_status;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        Log::info('attendance report');
        try {
            if ($this->church_status == 'Submitted') { //Division 

                $res =  BranchProperty::select(['div.division_name','br.church_name','pastor_name', 
                'meeting_place', 'own_land', 'other_lands', 'available_doc', 
                'registration_stage', 'document_location', 'remarks'])
                ->join('branches as br', 'br.id', '=', 'branch_properties.branch_id')
                ->join('divisions as div', 'br.division_id', '=', 'div.id')
                ->where('br.division_id', 'like', '%' . $this->division_id . '%')
                ->orderBy('division_id')->orderBy('church_name')
                ->get();
            } else {
                $res =  Branch::select(['church_name', 'div.division_name'])
                ->join('divisions as div', 'branches.division_id', '=', 'div.id')
                ->where('branches.division_id', 'like', '%' . $this->division_id . '%')
                ->whereNotIn('branches.id', function ($q) {
                    $q->select('branch_id')->from('branch_properties');
                })
                ->orderBy('division_id')->orderBy('church_name')
                ->get();
            }

            


            return $res;
        } catch (\Exception $exception) {

            Log::error('error: report attendance' . $exception->getMessage());
            return back()->with(['errormessage' => $exception->getMessage()]);
        }
    }

    public function headings(): array
    {
        $headingArray = [
            'Division', 'Branch', 'Pastor Name', 'Meeting Place', 'Own_Land',    'Other Lands',    'Available Docs',
            'Reg Stage', 'Doc Location', 'Remark'
        ];

        return $headingArray;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true, 'size' => 14]],
        ];
    }
}
