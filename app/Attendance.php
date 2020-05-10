<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes;
    protected $table = 'attendance';
    protected $fillable = ['user_id','attendance_date','image'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }
}
