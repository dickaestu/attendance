<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\RequestTimeOff;
use App\RequestOvertime;
use App\Attendance;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_picture','roles'
    ];

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

    public function time_off(){
        return $this->hasMany(RequestTimeOff::class, 'user_id', 'id');
    }

    public function overtime(){
        return $this->hasMany(RequestOvertime::class, 'user_id', 'id');
    }

    public function attendance(){
        return $this->hasMany(RequestOvertime::class, 'user_id', 'id');
    }
}
