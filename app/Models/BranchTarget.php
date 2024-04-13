<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchTarget extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'attendance',
        'income',
        'attendance_criteria',
        'income_criteria',
        'target_year',
        'maker_id'         
    ];

}
