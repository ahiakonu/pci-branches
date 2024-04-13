<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Division extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'division_name',
        'country',
        'divisional_leader',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function($model){
            if(DB::table('divisions')->exists()){
                $model->id = 'DV'. substr(Division::max('id'),2,3) + 1;
            }
            else{
                $model->id = 'DV101';
            }
        });
    }

    public function zones()
    {
        return $this->hasMany(Zone::class);
    }
}
