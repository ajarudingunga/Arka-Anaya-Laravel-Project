<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table = 'user_data';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['user_id', 'user_enrollmentno', 'user_firstname', 'user_lastname', 'user_mobileno', 'user_department', 'user_resiatcapus', 'user_address', 'user_city', 'user_postcode', 'user_balance','updated_at','created_at'];
}
