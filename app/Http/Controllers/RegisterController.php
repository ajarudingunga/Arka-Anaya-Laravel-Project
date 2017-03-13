<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Auth;
use Validator;
use Input;
use App\User;
use App\UserData;
use App\Role;
use Hash;


class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function storePostData(Request $request)
    {
        $rules = array(
            'email' => 'required|email|max:255|unique:users',
            'account_type' => 'required',
            'enrollment' => 'required|numeric|unique:users',
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'mobile' => 'required|numeric',
            'department' => 'required',
            'address' => 'required',
            'city' => 'required|max:70',
            'postcode' => 'required|numeric',
            'agree' => 'required',
        );
        $messages = [
            'email.required' => 'The Email field is required.',
            'agree.required' => 'For registration request you must have to Accept our privacy policy',
            'enrollment.unique' => 'Oops!! Using this enrollment someone already registered !!',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('register')
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
            //inserting into user table
            $User = new User();
            $User->firstName = $request->firstName." ". $request->lastname;
            $User->email = $request->email;
            $User->enrollment = $request->enrollment;
            $User->status = "0";
            $User->password = Hash::make("123");

            if ($User->save()) {
                // Insert to role to users_role table
                $role = new Role();
                $role->userId = $User->userId;
                $role->roleType = "1";

                if ($role->save()) {

                    $Userdata = new UserData();
                    $Userdata->user_id = $User->userId;
                    $Userdata->user_firstname = $request->firstname;
                    $Userdata->user_lastname = $request->lastname;
                    $Userdata->user_mobileno = $request->mobile;
                    $Userdata->user_department = $request->department;
                    $Userdata->user_resiatcapus = "1";
                    $Userdata->user_address = $request->address;
                    $Userdata->user_city = $request->city;
                    $Userdata->user_postcode = $request->postcode;
                    $Userdata->user_balance = "0";

                    if ($Userdata->save()) {
                        return redirect('login');
                    }
                }
            } else {
                $response['status'] = '0';
                $response['message'] = 'Opps.. something went wrong, please try again.';
            }

        }
    }
}
