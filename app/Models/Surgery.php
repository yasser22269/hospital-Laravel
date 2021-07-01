<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{
    protected $guarded = [];
    protected $dates = ['startTime', 'endTime'];
    public function doctor()
    {
        return $this->belongsTo(Admin::class,'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
