<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    protected $fillable = ['id' , 'user_id', 'cart', 'updated_at', 'created_at', 'product_type'];


    public static function allOrders()
    {
        $queryString = DB::table((new static)->getTable());
           $result = $queryString->get();
           return $result;
    }

    // public static function userOrders($id)
    // {
    //     $queryString = DB::table((new static)->getTable());
    //        $result = $queryString->get();
    //        return $result;
    // }
}
