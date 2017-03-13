<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Input;
use Session;
use DB;
use App\RechargeTransaction;
use App\UserData;

class RechargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alltansactionResult = RechargeTransaction::allRechargeTransactions();
        return view('admin.newrecharge',
           [
               'alltansactionResult' => $alltansactionResult,
           ]
        );
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
        $rules = array(
            'enrollment' => 'required',
            'amount' => 'required|numeric',
        );
        $messages = [
            'amount.numeric' => 'Amount Must in Numeric',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('admin/recharge')
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
            $useRetrive = DB::table('users')->where('enrollment', $request->enrollment)->first();

            if (isset($useRetrive->userId)) {

                $useBalance = DB::table('user_data')->where('user_id', $useRetrive->userId)->first();
                $newBalannce = $useBalance->user_balance + $request['amount'];

                $balUpdate = UserData::find($useBalance->id);

                $balUpdate->user_balance = $newBalannce;
                $balUpdate->save();

                $recharge= new RechargeTransaction();
                $recharge->enrollment = $request['enrollment'];
                $recharge->amount = $request['amount'];
                $recharge->status= "1";

                if ($recharge->save())
                {
                    Session::flash('message', ' Voila !! Recharge Done');
                    Session::flash('alert-class', 'alert-success');
                    return redirect('admin/recharge');
                }else
                {
                    Session::flash('message', 'Oops !! Something went wrong!');
                    Session::flash('alert-class', 'alert-danger');
                    return redirect('admin/recharge');
                }
            }else{

                $recharge= new RechargeTransaction();
                $recharge->enrollment = $request['enrollment'];
                $recharge->amount = $request['amount'];
                $recharge->status= "0";
                $recharge->save();

                Session::flash('message', 'Sorry!! Account does not exist !!');
                Session::flash('alert-class', 'alert-danger');
                return redirect('admin/recharge');
            }


        }
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
