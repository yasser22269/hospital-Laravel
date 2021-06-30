<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(Admin::class,'user_id');
    }
}
