<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class BranchReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'service_date',
        'service_id',
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

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->amalgamation = ($model->tithe + $model->first_offering) * 0.2;
            $model->amalgamation_paid = 0.0;
        });

        static::updating(function ($model) {
            $model->amalgamation = ($model->tithe + $model->first_offering) * 0.2;
            $model->amalgamation_paid = 0.0;
        });
    }
}
