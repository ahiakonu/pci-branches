<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionalReport extends Model
{
    use HasFactory;


    protected $fillable = [
        'division_id',
        'report_year',
        'report_month',
        'month_key',
        'visit_any_branch',
        'branches_visisted',
        'branches_paid_amalg',
        'branches_not_paid_amalg_details',
        'sent_amalg',
        'not_sent_amalg_details',
        'amalg_defaults',
        'amalg_defaults_branches',
        'amalg_defaults_action',
        'compliance_issues',
        'compliance_issues_detalis',
        'divisional_programs',
        'divisional_ptogram_details',
        'all_branches_attended',
        'all_branches_attended_details',
    ];

    public function getCreatedAtAttribute($date)  {
        return \Carbon\Carbon::parse($date)->format('d/m/Y');
    }
}
