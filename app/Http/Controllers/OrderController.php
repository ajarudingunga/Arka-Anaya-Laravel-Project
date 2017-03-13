<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\UserData;
use Session;
use App\Orders;
use App\Payment;
use App\User;
use Redirect;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if (isset(Auth::user()->userId)) {
            //check balance in account
            $userid = Auth::user()->userId;
            $userDetail = UserData::where('user_id','=', $userid)->first();
            $userAccountBalance = $userDetail['user_balance'];

            $cart = Session::get('cart');
            $cartTotal = $cart->totalPrice;

            if ($userAccountBalance < $cartTotal) {
                Session::flash('message', 'Sorry,,You have not enough balance in your Account to order!!');
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
            }
            else
            {
                //order table entry
                $order = new Orders();
                $order->user_id = $userid;
                $order->cart = serialize($cart);
                $order->save();

                //payment table entry
                $payment = new Payment();
                $payment->user_id = $userid;
                $payment->amount = $cartTotal;
                $payment->order_id = $order->id;

                //update user balance
                $newBalance = $userAccountBalance - $cartTotal;
                $userDetail = UserData::where('user_id','=', $userid)->first();
                $userDetail->user_balance = $newBalance;

                if ( $payment->save() && $userDetail->save()) {

                    //order details to the reciept
                    $userenrll = User::where('userId','=', $userid)->first();
                    $userenrll = $userenrll->enrollment;
                    $cartdata = $cart;
                    $orderid =  $order->id;
                    $ordertime = $payment->created_at;

                    //flushing cart
                    Session::forget('cart');

                    return view('user.orderecipt',[
                        'orderid'=> $orderid,
                        'userenrll'=> $userenrll,
                        'cartdata'=> $cartdata,
                        'ordertime'=> $ordertime,
                        'cartTotal' => $cartTotal,
                    ]);

                };
            }
        }
        else
        {
            return redirect('/login');
        }
    }

    public function showAccount()
    {
        return view('user.account');
    }

    public function showRecipt()
    {
        return view('user.orderecipt');
    }

    public function showOrders()
    {
        $userid = Auth::user()->userId;
        $orders = Orders::where('user_id','=', $userid)->get();
        $orders->transform(function($order,$key){
            $order->cart = unserialize($order->cart);
            return $order ;
        });
        return view('user.ordersview',['orders'=> $orders]);
    }



    public function adminViewOrders()
    {
        $orders = Orders::orderBy('id', 'DESC')->get();
        $orders->transform(function($order,$key){
            $order->cart = unserialize($order->cart);
            return $order ;
        });
        return view('admin.ordersview',['orders'=> $orders]);
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
