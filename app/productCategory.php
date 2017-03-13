<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class productCategory extends Model
{
    protected $table = 'product_category';
    protected $fillable = ['id','category_name','category_desc','category_active_status'];
    public $timestamps = false;

    public static function getAllCategories()
    {
        $queryString = DB::table((new static)->getTable());
           $result = $queryString->get();
           return $result;
    }
}
