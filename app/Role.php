<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
    */
    protected $table = 'users_role';
    protected $primaryKey = 'roleId';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['userId', 'roleType', 'moduleAccess', 'createdAt', 'updatedAt'];

    public function users()
    {
        return $this->hasMany('App\User', 'roleId', 'userId');
    }
}
