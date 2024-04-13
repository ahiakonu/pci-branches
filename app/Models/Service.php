<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Service extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'service',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function($model){
            if(DB::table('services')->exists()){
                $model->id = Service::max('id')+ 1;
            }
            else{
                $model->id = '100';
            }
        });
    }
}
