@extends('layouts.master')

@section('content')

<div id="container">
  <div class="container">
    <!-- Breadcrumb Start-->
    <ul class="breadcrumb">
      <li><a href="index.html"><i class="fa fa-home"></i></a></li>
      <li><a href="login.html">Account</a></li>
      <li><a href="login.html">Login</a></li>
    </ul>
    <!-- Breadcrumb End-->
    <div class="row">
      <!--Middle Part Start-->
      <div id="content" class="col-sm-9">
        <h1 class="title">Account Login</h1>
        <div class="row">
          <div class="col-sm-6">
            <h2 class="subtitle">New Customer</h2>
            <p><strong>Request a new Account</strong></p>
            <p>By creating an account you will be able to purchase faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
            <a href="{{url('register')}}" class="btn btn-primary">Continue</a> </div>
          <div class="col-sm-6">
            <h2 class="subtitle">Returning Customer</h2>
            <p><strong>I am a returning customer</strong></p>

            @if(session('errormessage'))
            <div class="alert alert-danger alert-dismissible">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {{ session('errormessage') }}
            </div>
            @endif

            <form  action="{{url('auth/login')}}" method="post">
              {{ csrf_field()}}
              <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="control-label" for="input-email">E-Mail Address</label>
                <input type="text" name="email" value="{{ old('email') }}" placeholder="E-Mail Address"  class="form-control" autofocus />

                @if ($errors->has('email'))
                    <span class="help-block alert alert-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="control-label" for="input-password">Password</label>
                <input type="password" name="password" value="" placeholder="Password" class="form-control" />

                @if ($errors->has('password'))
                    <span class="help-block alert alert-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <br />
                <a href="{{ url('password/email') }}">Forgotten Password</a></div>
              <input type="submit" value="Login" class="btn btn-primary" />
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
