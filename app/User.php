<?php
namespace App;

use DB;
use Auth;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $primaryKey = 'userId';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['authId', 'authProvider', 'firstName', 'lastName', 'username', 'email', 'createdBy', 'createdAt', 'updatedBy', 'updatedAt', 'status'];


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    public function getEmail()
    {
        return $this->email;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function role()
    {
        return $this->hasOne('App\Role','userId');
    }

    public function getUserRole()
    {
        switch($this->role()->getResults()->roleType) {
            case 0:
                return "admin"; break;
            case 1:
                return "user"; break;
            default:
                return "user"; break;
        }
    }

    public function hasRole($role)
    {
        return ($this->role()->getResults()->roleType == 0 && $role == "admin" || $this->role()->getResults()->roleType == 1 && $role == "user");
    }

    public function getTotalNumberUser()
    {
        return DB::table($this->table)->where("user_type", "!=", "1")->count();
    }

    public function getTotalNumberUserRequests()
    {
        return DB::table($this->table)->where("status", "=", "0")->count();
    }

    public function viewUser($userId)
    {
        return DB::table($this->table)->where("userId", $userId)->get();
    }

    public function is_userVerified()
    {
        if (empty($this->verification_code)) { // whether if user is verified return 1 otherwise return 0
            return 1;
        } else{
            return 0;
        }
    }

    public function getRegisteredUser($loggin_userId)
    {
        return DB::table($this->table)->where('status','Active')->where('user_type',"!=",1)->where('userId','!=',$loggin_userId)->orderBy('firstname','ASC')->get();
    }

    public function changePassword($email,$password)
    {
        return DB::table($this->table)->where('email',$email)->update(['password' => $password]);
    }
}
