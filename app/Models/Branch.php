<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Branch extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'church_name',
        'church_location',
        'church_email',
        'church_address',
        'division_id',
        'zone_id',
        'currency',
        'city',
        'year_established',
        'website',
        'church_status',
        'g_lat',
        'g_long', 
    ];

    
    public static function boot()
    {
        parent::boot();
        static::creating(function($model){
            $model->g_lat = '00';
            $model->g_long = '00';
            if(DB::table('branches')->exists()){
                $model->id = 'CH'. substr(Branch::max('id'),2,4) + 1;
            }
            else{
                $model->id = 'CH1001';
            }
        });
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function user(){
        return $this->hasOne(User::class,'user_role_id');
    }

    public function targets()
    {
        return $this->hasMany(BranchTarget::class);
    }

    public function property(){
        return $this->hasOne(BranchProperty::class);
    }
}
