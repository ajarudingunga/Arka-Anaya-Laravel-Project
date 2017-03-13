<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cart;
use App\Product;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use App\Wishlist;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if (!Session::has('cart')) {
            
            Session::flash('message', 'Cart is Empty!');
            Session::flash('alert-class', 'alert-warning');
            return redirect()->back();
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('user.cartview',['products'=> $cart->items ,'totalPrice' => $cart->totalPrice]);
    }

    public function addToCart(Request $request , $id)
    {

        $product = DB::table('product')->where('id', $id)->first();

        $oldCart = Session::has('cart') ? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product , $product->id );

        $request->session()->put('cart',$cart);
        return redirect()->back();
    }

    public function addToCartandremovewishlist(Request $request , $id)
    {
        $findproduct = Wishlist::find($id)->first();
        $pid  = $findproduct->product_id;

        $product = DB::table('product')->where('id', $pid)->first();

        $oldCart = Session::has('cart') ? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product , $product->id );

        $request->session()->put('cart',$cart);
        if(Wishlist::destroy($id)){
            Session::flash('message', 'Item Moved to Cart !!');
            Session::flash('alert-class', 'alert-success');
            return redirect()->back();
        }
    }



    public function incrementCart(Request $request , $id)
    {

        $oldCart = Session::has('cart') ? Session::get('cart'):null;
        $cart = new Cart($oldCart);

        $cart->incrementData($id);

        $request->session()->put('cart',$cart);
        return redirect()->back();
    }

    public function decrementCart(Request $request , $id)
    {

        $oldCart = Session::has('cart') ? Session::get('cart'):null;
        $cart = new Cart($oldCart);

        $cart->decrementData($id);

        $request->session()->put('cart',$cart);
        return redirect()->back();
    }
    public function removeAll(Request $request , $id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart'):null;
        $cart = new Cart($oldCart);

        $cart->removeItemFromCart($id);

        $request->session()->put('cart',$cart);
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
