@extends('layouts.cmsMaster')
@section('title','Sign Up')
@section('content')
<style>
.has-error {
    color: red;
}</style>
<div class="container innersignup_container">

<h2 class="signupheading">SIGN UP</h2>
    @if (session('success-message'))
    <div class="alert alert-success alert-dismissible">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{ session('success-message') }}
      </div>
    @endif

    @if (session('error-message'))
    <div class="alert alert-danger alert-dismissible">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i> Failed! </h4>
        {{ session('error-message') }}
      </div>
    @endif

<div class="signupwhite_bg">

  <div class="innersignupform_holder">
    <form class="signupForm" name="signupForm" id="signupForm" method="post" action="{{url('/auth/register')}}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <ul>
  <li>
  <div class="inputdv">
    <input type="text"  value="{{ old('firstName') }}"  placeholder="Enter First Name" class="firstName" name="firstName" id="firstName"   />
  <i class="fa fa-user"></i>
  </div>
@if ($errors->has('firstName'))  <span class="loginerror has-error">{!!$errors->first('firstName')!!}</span>@endif
  </li>

   <li>
  <div class="inputdv">
  <input type="text" maxlength="35" value="{{ old('lastName') }}" placeholder="Enter Last Name" class=" lastName" name="lastName" id="lastName" /><i class="fa fa-user"></i>
  </div>
@if ($errors->has('lastName'))  <span class="loginerror has-error">{!!$errors->first('lastName')!!}</span>@endif
  </li>


   <li>
  <div class="inputdv">
  <input type="text"  placeholder="Enter Email" value="{{ old('email') }}"  class="email" name="email" id="email" /><i class="fa fa-envelope"></i>
  </div>
  @if ($errors->has('email'))  <span class="loginerror has-error">{!!$errors->first('email')!!}</span>@endif
  </li>
  <li>
    <div class="inputdv">
    <input type="password" name="password" id="password" maxlength="15" class="password" placeholder="Password"><i class="fa fa-lock"></i>
    </div>
  @if ($errors->has('password'))  <span class="loginerror has-error">{!!$errors->first('password')!!}</span>@endif
  </li>
  <li>
    <div class="inputdv">
    <input type="password" name="confirmed_password" id="confirmed_password" maxlength="15" class="confirmed_password" placeholder="Confirmed password"><i class="fa fa-lock"></i>
    </div>
    @if ($errors->has('confirm_password'))  <span class="loginerror has-error">{!!$errors->first('confirm_password')!!}</span>@endif
  </li>
  <!-- <li>
By signing up, I agree to KarConnect’s <a href="#">Terms of Service</a> &amp; <a href="#">Privacy Policy</a>.
  </li> -->

    <li class="Signup_btn">
          <input type="submit" value="Sign up" class="signupBtn" id="signupBtn">
  </li>

  <li class="ord"><p>or</p></li>

     <li class="Signup_facebook">
     <i class="fa fa-facebook"></i>
     <a href="{!!URL::to('facebook')!!}">Sign up with Facebook</a>

  </li>

  <li class="alredy"><p>Already a Member? <a href="{{url('/login')}}">Log In</a></p></li>

  </ul>
</form>

  </div>
</div>
</div>


@stop
