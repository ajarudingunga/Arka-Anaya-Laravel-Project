<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class DailyCuisine extends Model
{
    protected $table = 'daily_cuisine';

    protected $fillable = ['id' , 'cuisine_day', 'cuisine_time', 'product_id','cuisine_status'];

    public $timestamps = false;

    public static function allCuisine()
    {
        $queryString = DB::table((new static)->getTable());
           $result = $queryString->get();
           return $result;
    }
}
