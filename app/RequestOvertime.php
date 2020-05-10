<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestOvertime extends Model
{
    use SoftDeletes;
    protected $table = 'request_overtime';
    protected $fillable = ['user_id','request_date','overtime_duration','description','status_request'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }
}
