@extends('layouts.cmsMaster')
@section('title','Verification')
@section('content')
<style>
.has-error {
    color: red;
}</style>
<div class="container innersignup_container blank_page_height">

<h2 class="signupheading">Account Activate</h2>


<div class="signupwhite_bg">
  <div class="innersignupform_holder">
    @if(isset($alreadyactive))
    <p>{{$alreadyactive}}<a href="{{url('/login')}}"> Login</a></p>
      @else
      <p>Your KarConnect account has been activated successfully please click <a href="{{url('/login')}}">Login</a></p>
    @endif
  </div>
</div>
</div>


@stop
