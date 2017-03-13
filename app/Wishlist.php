<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Wishlist extends Model
{
    protected $table = 'wishlist';
    protected $fillable = ['id' , 'user', 'product_id'];
    public $timestamps = false;

    public static function allWishitem()
    {
        $userid = Auth::user()->userId;
        $data = Wishlist:: where('user_id','=', $userid);
        $data = $data->get();
        return $data;
    }
}
