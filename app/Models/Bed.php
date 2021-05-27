<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    protected $guarded = [];


    public function Patient()
    {
        return $this->hasMany(Patient::class,'bed_id');
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
