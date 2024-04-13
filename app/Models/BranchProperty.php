<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchProperty extends Model
{
    use HasFactory;

    protected $fillable = [
       'branch_id', 'pastor_name', 'meeting_place', 'own_land', 'other_lands', 'available_doc', 'registration_stage', 'document_location', 'remarks', 'photo1', 'photo2'
    ];


   /*  public function branch()
    {
        return $this->belongsTo(Branch::class);
    } */
}
