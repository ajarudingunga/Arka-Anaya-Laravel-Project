<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RechargeTransaction extends Model
{
    protected $table = 'recharge_transaction';
    protected $fillable = ['id','enrollment','amount','status','createdAt','updatedAt'];

    public static function allRechargeTransactions()
    {
        $queryString = DB::table('recharge_transaction')->orderBy('id', 'DESC');
        $result = $queryString->get();
        return $result;
    }
}
