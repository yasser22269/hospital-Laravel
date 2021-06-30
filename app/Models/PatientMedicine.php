<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientMedicine extends Model
{
    protected $guarded = [];


    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Admin::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function getIsActive(){
        return  $this->active  == 0 ?  'غير مفعل'   : 'مفعل' ;
    }

    public  function scopeActive($query){
        return $query->where('active',1);
    }

    public  function scopeDoseAmountNull($query){
        return $query->where('doseAmount','!=',0);
    }

}
