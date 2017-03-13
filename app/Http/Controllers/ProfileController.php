<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\UserData;
use App\User;
use Validator;
use Session;
use Input;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $userid = Auth::user()->userId;
        $user =User::where('userId','=',$userid)->first();
        $userDetails =UserData::where('user_id','=',$userid)->first();

        return view('user.profile',
           [
               'userDetails' => $userDetails,
               'user' =>$user,
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
    public function update(Request $request)
    {


        $rules = array(
            'email' => 'required|email|max:255',
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'mobile' => 'required|numeric',
            'department' => 'required',
            'address' => 'required',
            'city' => 'required|max:70',
            'postcode' => 'required|numeric',
        );
        $messages = [
            'email.required' => 'The Email field is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('user/profile')
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
            $userid = Auth::user()->userId;
            //updating user into user table

            $User = User::where('userId',$userid)->first();
            $User->email = $request->email;

            if ($User->save()) {

                // update to role to users_role table
                $Userdata = UserData::where('user_id',$userid)->first();
                $Userdata->user_firstname = $request->firstname;
                $Userdata->user_lastname = $request->lastname;
                $Userdata->user_mobileno = $request->mobile;
                $Userdata->user_department = $request->department;
                $Userdata->user_address = $request->address;
                $Userdata->user_city = $request->city;
                $Userdata->user_postcode = $request->postcode;

                if ($Userdata->save()) {
                    Session::flash('message', 'Updates Succesfully !!');
                    Session::flash('alert-class', 'alert-success');
                    return redirect('user\profile');
                }
            } else {
                $response['status'] = '0';
                $response['message'] = 'Opps.. something went wrong, please try again.';
            }
        }
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
