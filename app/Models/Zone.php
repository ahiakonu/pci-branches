<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Zone extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'division_id',
        'zone_name',
        'zonal_leader',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function($model){
            if(DB::table('zones')->exists()){
                $model->id = 'ZN'. substr(Zone::max('id'),2,3) + 1;
            }
            else{
                $model->id = 'ZN101';
            }
        });
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
