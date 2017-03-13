<?php
namespace App\Helper;

use Auth;
use App\UserConfiguration;
use Illuminate\Support\Facades\DB;
use App\Helper\GlobalHelper;
use App\productCategory;
use App\DailyCuisine;
use App\Product;
use App\Wishlist;
use App\UserData;
use App\User;

use Carbon\Carbon;

use DateTime;
use DateInterval;
use DatePeriod;

class GlobalHelper {

    public static function getCountActiveUser()
    {
        $queryString = DB::table('users');
        $queryString->where('status', '=', '1');
        $result = $queryString->count();
        return $result;
    }


    public static function getCountRequest()
    {
        $queryString = DB::table('users');
        $queryString->where('status', '=', '0');
        $result = $queryString->count();
        return $result;
    }
    public static function getCountProducts()
    {
        $queryString = DB::table('product');
        $queryString->where('product_status', '=', '1');
        $result = $queryString->count();
        return $result;
    }

    public static function getCategoryName($id)
    {
         $queryString = DB::table('product_category')
                       ->where('id', '=', $id)
                       ->first();
        return $queryString->category_name;
    }

    public static function getAllCategory()
    {
        $data = productCategory::where('category_active_status', 1);
        $d = $data->get();
        return $d;
    }


    public static function getCuisine()
    {
        $day = date('l');
        $cuisineItems = DB::table('daily_cuisine')
            ->join('product', 'daily_cuisine.product_id', '=', 'product.id')
            ->where('daily_cuisine.cuisine_day' ,'=', $day)
            ->select('product.*', 'daily_cuisine.*')
            ->get();

        return $cuisineItems;
    }


    public static function getFeaturedProducts()
    {
        $data = Product:: where('featured','=', 1);
        $d = $data->get();
        return $d;
    }

    public static function getAllProducts()
    {
        $data = Product:: where('product_status','=', 1);
        $d = $data->get();
        return $d;
    }

    public static function getRandomPic(){
        $randomImg = Product::orderBy(\DB::raw('RAND()'))->take(11)->skip(30)->get();
        return $randomImg;
    }

    public static function getToday(){

        return date('l');
    }

    public static function getWishlistCount()
    {
        $userid = Auth::user()->userId;

        $data = Wishlist:: where('user_id','=', $userid)->count();
        return $data;
    }


    public static function getUserBalace()
    {
        $userid = Auth::user()->userId;
        $data = UserData:: where('user_id','=', $userid)->first();
        return $data->user_balance;
    }

    public static function getUserEnrollment($id)
    {

        $data = User:: where('userId','=', $id)->first();
        return $data->enrollment;
    }

}
?>
