<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = ['id' , 'user_id', 'created_at','updated_at','amount','order_id'];

    public static function allpayments()
    {
        $userid = Auth::user()->userId;
        $queryString = Payment::where('user_id','=',$userid);
        $result = $queryString->get();
        return $result;
    }

    public static function getAllAdminPayment()
    {
        $queryString = Payment::orderBy('id', 'DESC');
        $result = $queryString->get();
        return $result;
    }

}
