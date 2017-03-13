<?php
namespace App\Http\Controllers;

use Redirect;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;
use Session;
use App\UserConfiguration;
use App\Role;
use App\User;
class AccountController extends Controller {
  // To redirect github
  public function facebook_redirect() {

    if(\Auth::check()){
        return redirect(\Auth::user()->getUserRole().'/dashboard');
    }else{
        return Socialite::with('facebook')->redirect();
    }
  }
  // to get authenticate user data
  public function facebook() {




    $facebook_user = Socialite::with('facebook')->user();
    // Do your stuff with user data.
    //check user already exists in db


    $existUser = User::where('authId', $facebook_user->id)->first();


    if($existUser) {
        $tempExistUser=$existUser->toArray();
        if($tempExistUser['status']=='1'){
          // if exist, log user into your application
          //  and redirect to any path you want
          \Auth::login($existUser);
          if (Session::has('redirect_path'))
          {
           return redirect(Session::get("redirect_path"));
          }
          return redirect('user/dashboard');
        }else {
          return redirect('/login')->with('errormessage', 'Your account is blocked, please contact to KarConnect admin (admin@karconnect.com).');
        }

    }
    else{
      //if not exist, create new user,
    // log user into your application

    $user = new \App\User ;
    $user->authId = $facebook_user->id;

    if(isset($facebook_user->user['email']) && !empty($facebook_user->user['email'])){
        $user->email=$facebook_user->user['email'];
    }
    if(isset($facebook_user->user['first_name']) && !empty($facebook_user->user['first_name'])){
        $user->firstName=$facebook_user->user['first_name'];
    }
    if(isset($facebook_user->user['last_name']) && !empty($facebook_user->user['last_name'])){
      $user->lastName=$facebook_user->user['last_name'];
    }
    if(isset($facebook_user->user['gender']) && !empty($facebook_user->user['gender'])){
      $user->gender=$facebook_user->user['gender'];
    }
    if(isset($facebook_user->avatar) && !empty($facebook_user->avatar)){
      $user->image=$facebook_user->avatar;
    }
    $user->authProvider='Facebook';
    $user->status=1;
    $user->save();

    $user_role_model=new Role();
    $user_role_model->roleType=4;
    $user_role_model->userId=$user->userId;
    $user_role_model->save();

    $userConfi=UserConfiguration::where('userId',$user->userId)->count();
    if(($userConfi)<1){
      $configuration_model=new UserConfiguration();
      $configuration_model->userId=$user->userId;
      $configuration_model->save();
    }

    \Auth::login($user); // login user
    if (Session::has('redirect_path'))
    {
     return redirect(Session::get("redirect_path"));
    }
    return redirect('user/profile'); // redirect
    }


  }

  // To redirect github
  public function twitter_redirect() {
    return Socialite::with('twitter')->redirect();
  }

  // to get authenticate user data

  public function twitter() {
    $twitter_user = Socialite::with('twitter')->user();
    // Do your stuff with user data.

    $existUser = User::where('twitter_id', $twitter_user->id)->first();

    if($existUser) {
        $existOrNot=Role::where('userId',$existUser->userId)->count();
        if($existOrNot<1){
          $user_role_model=new Role();
          $user_role_model->roleType=4;
          $user_role_model->userId=$existUser->userId;
          $user_role_model->save();
        }
        $userConfi=UserConfiguration::where('userId',$existUser->userId)->count();
        if(($userConfi)<1){
          $configuration_model=new UserConfiguration();
          $configuration_model->userId=$user->userId;
          $configuration_model->save();
        }
        $tempExistUser=$existUser->toArray();
        if($tempExistUser['status']=='Active'){
          // if exist, log user into your application
          //  and redirect to any path you want
          \Auth::login($existUser);
          if (Session::has('redirect_path'))
          {
           return redirect(Session::get("redirect_path"));
          }
          return redirect('user/profile');
        }else {
          return redirect('/login')->with('errormessage', 'You are not enable to login');
        }

    }
    else{
            //if not exist, create new user,
            // log user into your application

            $user = new \App\User ;
            $user->twitter_id = $twitter_user->id;

            if(isset($twitter_user->email) && !empty($twitter_user->email)){
              $user->email=$twitter_user->email;
            }
            if(isset($twitter_user->name) && !empty($twitter_user->name)){
                $nameArray=explode(' ',$twitter_user->name);

                if(isset($nameArray[0]) && !empty($nameArray[0]))
                  $user->firstname=$nameArray[0];

                if(isset($nameArray[1]) && !empty($nameArray[1]))
                    $user->lastname=$nameArray[1];
            }


            if(isset($twitter_user->avatar) && !empty($twitter_user->avatar)){
                $user->user_image=$twitter_user->avatar;
            }

            $user->status='Active';
            $user->save();
            $user_role_model=new Role();
            $user_role_model->roleType=4;
            $user_role_model->userId=$user->userId;
            $user_role_model->save();

            $configuration_model=new UserConfiguration();
            $configuration_model->userId=$user->userId;
            $configuration_model->save();

            \Auth::login($user); // login user
            if (Session::has('redirect_path'))
            {
             return redirect(Session::get("redirect_path"));
            }
            return redirect('user/profile'); // redirect
        }
    }



}
