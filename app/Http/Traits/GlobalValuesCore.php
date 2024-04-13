<?php

namespace App\Http\Traits;

use App\Models\Division;
use Illuminate\Support\Facades\DB;

trait GlobalValuesCore{
    public  function getReportYear()
    {
        return DB::select('select distinct YEAR(service_date) as reportyear from branch_reports');
    }
    public  function getDivisions()
    {
        return Division::orderBy('division_name')->get();
    }
    public  function getMonths()
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
    }
}