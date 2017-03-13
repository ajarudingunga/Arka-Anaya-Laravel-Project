<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\DailyCuisine;
use Validator;
use Input;
use Session;

class DailyCusineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getCuisine = DailyCuisine::allCuisine();
        return view('admin.dailycusine',
           [
               'getCuisine' => $getCuisine
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
            'day'  => 'required',
            'time' => 'required',
            'productid' => 'required',
        );
        $messages = [
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('admin/cuisine')
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
            $product= new DailyCuisine();
            $product->cuisine_day = $request['day'];
            $product->cuisine_time = $request['time'];
            $product->product_id = $request['productid'];
            $product->cuisine_status= "1";

            if ($product->save())
            {
                Session::flash('message', 'Product Succesfully Added!');
                Session::flash('alert-class', 'alert-success');
                return redirect('admin/cuisine');
            }else
            {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return redirect('admin/cuisine');
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

        if (DailyCuisine::destroy($id)) {
            Session::flash('message', 'Cuisine Deleted !!');
            Session::flash('alert-class', 'alert-success');
            return redirect('admin/cuisine');
        }
    }

    public function cuisineStatusToggle(Request $request,$id)
    {
        $user = DB::table('daily_cuisine')->where('id', $id)->first();

        if ($user->cuisine_status =="1") {

            $catStatus = DailyCuisine::find($id);
            $catStatus->cuisine_status= '0';
            if ($catStatus->save()) {
                Session::flash('message', 'Status Changed to Disabled');
                Session::flash('alert-class', 'alert-warning');
                return redirect('admin/cuisine');
            }

        }else {

            $catStatus = DailyCuisine::find($id);
            $catStatus->cuisine_status= '1';
            if ($catStatus->save()) {
                Session::flash('message', 'Status Changed to Enable');
                Session::flash('alert-class', 'alert-success');
                return redirect('admin/cuisine');
            }
        }

    }
}
