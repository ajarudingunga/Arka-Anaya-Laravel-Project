<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\ScheduleServiceProvider;
use App\Role;
use App\User;
use Guzzle\Plugin\Backoff\ConstantBackoffStrategy;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//home redirection route
Route::get('/', 'IndexController@index');

//general routes
Route::get('/shopping-cart', 'CartController@index');
Route::get('/addtocart/{id}', 'CartController@addToCart');

Route::get('/incrementCart/{id}', 'CartController@incrementCart');
Route::get('/decrementCart/{id}', 'CartController@decrementCart');
Route::get('/removeItemCart/{id}', 'CartController@removeAll');
Route::get('/makeOrder', 'OrderController@index');

Route::get('/addToWishlist/{id}', 'WishlistControlle@add');




//protected routes

Route::group(['middleware' => ['auth']], function()
{
    Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {

        Route::get('/dashboard','DashboardController@index' );
        //manege Products

        Route::get('/product','ProductController@index' );
        Route::post('/product','ProductController@store');
        Route::get('/product/delete/{id}','ProductController@destroy');
        Route::get('/product/toggleStatus/{id}','ProductController@productStatusToggle');
        Route::get('/product/toggleFeatured/{id}','ProductController@productFeaturedToggle');
        //manage cataegory
        Route::get('/categories','CategoryController@index' );
        Route::post('/categories','CategoryController@store');

        Route::get('/categories/toggleStatus/{id}','CategoryController@categoryStatusToggle');
        Route::get('/categories/delete/{id}','CategoryController@destroy');
        Route::get('/categories/update/{id}','CategoryController@updateShow');
        Route::post('/categories/update/{id}','CategoryController@update');

        //userRequest
        Route::get('/userRequest','userManageController@userRequest');
        Route::get('/userRequest/approve/{id}','userManageController@approverequets');

        //Recharge
        Route::get('/recharge','RechargeController@index' );
        Route::post('/recharge','RechargeController@store' );

        //user management
        Route::get('/users','userManageController@userList');
        Route::get('/users/block/{id}','userManageController@userBlock');
        Route::get('/users/view/{id}','userManageController@userView');
        Route::post('/users/view/{id}','userManageController@userViewUpdate');

        //cuisine management
        Route::get('/cuisine','DailyCusineController@index');
        Route::post('/cuisine','DailyCusineController@store');
        Route::get('/cuisine/toggleStatus/{id}','DailyCusineController@cuisineStatusToggle');
        Route::get('/cuisine/delete/{id}','DailyCusineController@destroy');

        //order an payment view
        Route::get('/all-orders','OrderController@adminViewOrders');
        Route::get('/all-orders-payments','PaymentController@adminViewPayments');


    });


    Route::group(['prefix' => 'user', 'middleware' => ['role:user']], function() {

        Route::get('dashboard', 'user\DashboardController@index');
        Route::get('/my-account', 'OrderController@showAccount');
        Route::get('/my-orders', 'OrderController@showOrders');
        Route::get('/my-wishlist', 'WishlistControlle@index');
        Route::get('/my-transactions', 'PaymentController@index');

        Route::get('/profile', 'ProfileController@index');
        Route::post('/update-profile','ProfileController@update');

        Route::get('/my-wishlist/remove/{id}', 'WishlistControlle@remove');
        Route::get('/my-wishlist/addtocartandremove/{id}', 'CartController@addToCartandremovewishlist');
        Route::get('/orderView', 'OrderController@showRecipt');

    });
});

Route::get('user/category/{id}', 'user\CategoryController@index');
Route::get('user/product/{id}', 'ProductController@userViewProduct');
Route::get('user/cuisine/{id}', 'ProductController@userViewCuisine');


//Authentication all Routes

Route::get('/admin', function(){
    return redirect('admin/login');
});

Route::get('/user', function(){
    return redirect('user/login');
});

Route::get('admin/login', function(){
    if (!Auth::check()) {
        return view('admin/login');
    } else {
        return redirect('admin/dashboard');
    }
});

Route::get('user/login', function(){
    if(!Auth::check()){
        return view('user/login');
    }else{
        return redirect('user/');
    }
});

Route::get('/login',function(){
    if(!Auth::check()){
        return view('Auth.login');
    }else{
        if (Auth::user()->getUserRole() == "Admin") {
            return redirect('/admin/dashboard');
        }
        else {
            return redirect('/');
        }

    }
})->name('userlogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');



//Registration routes

Route::get('register', 'RegisterController@index');
Route::post('register', 'RegisterController@storePostData');

Route::get('logout', 'Auth\AuthController@getLogout');


//forget pass routes
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('user/password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('user/password/reset', 'Auth\PasswordController@postReset');

//general routes

Route::get('auth/verifyaccount/{id}', 'Auth\AuthController@getVerifiedAccount');
Route::get('admin/password/email', 'Auth\PasswordController@getAdminEmail');
Route::post('admin/password/email', 'Auth\PasswordController@postAdminEmail');

Route::get('owner/password/email', 'Auth\PasswordController@getServiceCenterEmail');
Route::post('owner/email', 'Auth\PasswordController@postServiceCenterEmail');

Route::get('owner/password/reset/{token}', 'Auth\PasswordController@getServiceCenterReset');
Route::post('owner/password/reset', 'Auth\PasswordController@postServiceCenterReset');
