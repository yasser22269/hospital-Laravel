<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function getactive(){
    //     return $this->is_active ==0 ? 'غير مفعل' : "مفعل";
    // }


     public function shift()
     {
         return $this->belongsTo(Shift::class);
     }
     

     public  function scopeDoctor($query){
         return $query->where('type_id','doctor');
     }

     public  function scopeNurse($query){
        return $query->where('type_id','nurse');
    }

    public  function scopeManger($query){
        return $query->where('type_id','manger');
    }

}
