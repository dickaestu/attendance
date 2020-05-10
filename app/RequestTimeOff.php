<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestTimeOff extends Model
{
    use SoftDeletes;
    protected $table = 'request_time_off';
    protected $fillable = ['user_id','time_off_type','start_date','end_date','notes','file','status_request'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }
}
