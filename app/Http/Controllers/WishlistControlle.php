<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Wishlist;
use Auth;
use Session;
use DB;

class WishlistControlle extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = Auth::user()->userId;

        $wishlistItems = DB::table('wishlist')
            ->join('product', 'wishlist.product_id', '=', 'product.id')
            ->select('product.*', 'wishlist.*')
            ->where('wishlist.user_id', $userid)
            ->get();

        return view('user.wishlist',
           [
               'wishlistItems' => $wishlistItems,
           ]
        );
    }
    public function remove($id)
    {
        $productDelete = Wishlist::find($id);
        if (Wishlist::destroy($id)) {
            Session::flash('message', 'Item Deleted !!');
            Session::flash('alert-class', 'alert-warning');
            return redirect()->back();
        }
    }

    public function add($id)
    {
        if (isset(Auth::user()->userId)) {

            $userid = Auth::user()->userId;
            $wishlist = new Wishlist();
            $wishlist->user_id = $userid;
            $wishlist->product_id = $id;
            if ($wishlist->save()) {
                Session::flash('message', 'Added to the Wishlist');
                Session::flash('alert-class', 'alert-success');
                return redirect()->back();
            }
        }
        else
        {
            return redirect('/login');
        }
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
