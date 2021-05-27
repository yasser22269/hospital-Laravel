<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
     ];

    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }

    public function ChangesBed()
    {
        return $this->hasMany(ChangesBed::class);
    }

    public function getIsIsolted(){
        return  $this -> isIsolted  == 0 ?  'غير محجوز'   : 'محجوز' ;
     }

     
    public  function scopeIsolted($query){
        return $query->whereNull('isIsolted');
    }

    public  function scopeDischarged($query){
        return $query->whereNotNull('discharged');
    }
    
}
