<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class UserLog extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
    */
    protected $table = 'users_log';
    protected $primaryKey = 'logId';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = ['userId', 'userIp', 'browserInfo', 'loginTime', 'createdAt'];
}
