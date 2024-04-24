<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ZonalReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'zone_id',
        'zone_id',
        'branch_id',
        'branch_id',
        'report_month',
        'report_year',
        'month_key',
        'branch_visited',
        'pastor_follow_teaching',
        'total_first_offering',
        'total_tithe',
        'check_amalgamation',
        'amalgamation_paid',
        'algamation_correct',
        'attendance_inc_dec',
        'attendance_verified',
        'records_verified',
        'pastor_corporate',
        'zonal_comments',
    ];

    public function getCreatedAtAttribute($date)  {
        //Log::info('date -- '.$date);
        return Carbon::parse($date)->format('d/m/Y');
    }
}
