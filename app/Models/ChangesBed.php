<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChangesBed extends Model
{
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function bedfrom()
    {
        return $this->belongsTo(Bed::class,'fromBed_id');
    }
    public function bedTo()
    {
        return $this->belongsTo(Bed::class,'toBed_id');
    }
}
