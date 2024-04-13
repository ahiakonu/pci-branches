<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'original_name',
        'file_path',
        'status'
    ];
}
