<?php

namespace App\Exports;

use App\Models\Branch;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\Log;

class AdminBranchesReport implements FromCollection, WithHeadings, WithStyles
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
        Log::info('branches report');
        try {
            return Branch::select([
                'div.division_name',
                'z.zone_name',
                'church_name',
                'church_location',
                'church_email',
                'church_address',
                'currency',
                'city',
                'year_established',
                'website',
                'church_status',
                'div.country',
            ])
                ->join('divisions as div', 'branches.division_id', '=', 'div.id')
                ->join('zones as z', 'branches.zone_id', '=', 'z.id')
                ->where('church_status', 'like', '%' . $this->church_status . '%')
                ->where('branches.division_id', 'like', '%' . $this->division_id . '%')
                ->orderBy('div.division_name')->orderBy('church_name')
                ->get();
        } catch (\Exception $exception) {

            Log::error('error: report branches' . $exception->getMessage());
            return back()->with(['errormessage' => $exception->getMessage()]);
        }
    }
    public function headings(): array
    {
        $headingArray = [
            'Division', 'Zone',
            'Branch', 'Location', 'Email', 'Address', 'Curr', 'City','YearEstablished', 'Website', 'ChurchStatus', 'Country', ''
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
