<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class RequestForTrial extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
    */
    protected $table = 'requestForTrial';
    protected $primaryKey = 'requestId';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = ['firstName', 'lastName', 'email', 'restaurantName', 'cellPhone', 'city', 'state', 'scheduleName', 'dayParts', 'scheduleStartDay', 'hearAbout', 'createdAt', 'status'];
}
