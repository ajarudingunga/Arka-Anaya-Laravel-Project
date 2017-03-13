<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Input;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = ['id' , 'product_name', 'product_price', 'product_old_price', 'product_description', 'product_category_id', 'product_type', 'product_image_url', 'product_status'];

    public $timestamps = false;

    public static function allProduct()
    {
        $queryString = DB::table((new static)->getTable());
           $result = $queryString->get();
           return $result;
    }
}
