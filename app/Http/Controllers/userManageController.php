<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\UserData;
use DB;
use Session;
use Validator;
use Input;

class userManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function userRequest()
    {
        $userRequest = DB::table('users')
            ->join('user_data', 'users.userId', '=', 'user_data.user_id')
            ->select('users.*', 'user_data.*')
            ->where('users.status', '0')
            ->get();

        return view('admin.userRequest',
           [
              'userRequest' => $userRequest,
           ]
       );
    }

    public function userList()
    {
        $usersList = DB::table('users')
            ->join('user_data', 'users.userId', '=', 'user_data.user_id')
            ->select('users.*', 'user_data.*')
            ->get();

        return view('admin.userlist',
           [
              'usersList' => $usersList,
           ]
       );
    }

    public function userView($id)
    {
        $usersList = DB::table('users')
            ->join('user_data', 'users.userId', '=', 'user_data.user_id')
            ->select('users.*', 'user_data.*')
            ->where('users.userId', '=',$id)
            ->first();

        return view('admin.userdataUpdate',
           [
              'usersList' => $usersList,
           ]
       );
    }

    public function approverequets(Request $request,$id)
    {
        $user = User::find($id);
        $user->status= "1";
        if ($user->save()) {
            Session::flash('message', 'Account has been Approved');
            Session::flash('alert-class', 'alert-success');
            return redirect('admin/userRequest');
        }

    }

    public function userBlock(Request $request,$id)
    {
        $user = DB::table('users')->where('userId', $id)->first();

        if ($user->status =="1") {

            $catStatus = User::find($id);
            $catStatus->status= "-1";
            if ($catStatus->save()) {
                Session::flash('message', 'User Blocked');
                Session::flash('alert-class', 'alert-warning');
                return redirect('admin/users');
            }

        }else {
            $catStatus = User::find($id);
            $catStatus->status= "1";
            if ($catStatus->save()) {
                Session::flash('message', 'User Activated');
                Session::flash('alert-class', 'alert-success');
                return redirect('admin/users');
            }
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

    public function userViewUpdate(Request $request , $id)
    {
        $rules = array(
            'email' => 'required|email|max:255',
            'enrollment' => 'required|numeric',
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'mobile' => 'required|numeric',
            'adress' => 'required',
            'city' => 'required|max:70',
            'postcode' => 'required|numeric',
        );
        $messages = [
        ];
        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('admin/users/view/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }
        else{
            DB::table('users')->where('userId', $id)->update(
                [
                    'firstname' => $request->firstname,
                    'email' => $request->email,
                    'enrollment' => $request->enrollment,
                ]
            );

            DB::table('user_data')->where('user_id', $id)->update(
                [
                    'user_firstname' => $request->firstname,
                    'user_lastname' => $request->lastname,
                    'user_mobileno' => $request->mobile,
                    'user_address' => $request->adress,
                    'user_city' => $request->city,
                    'user_postcode' => $request->postcode,
                ]
            );
            Session::flash('message', 'Data updated');
            Session::flash('alert-class', 'alert-success');
            return redirect('admin/users');
        }
    }
}
