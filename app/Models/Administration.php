<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    protected $guarded = [];


    public function userAdmin()
     {
         return $this->belongsTo(Admin::class,'nurse_id');
     }

     public function prescription()
     {
         return $this->belongsTo(PatientMedicine::class,'prescription_id');
     }
}
