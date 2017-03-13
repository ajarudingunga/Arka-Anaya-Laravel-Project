@extends('layouts.master')

@section('content')

<div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Account</a></li>
        <li><a href="#">Register</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div class="col-sm-9" id="content">
          <h1 class="title">Request for Account</h1>
          <p>If you already have an account with us, please login at the <a href="">Login Page</a>.</p>
          <form class="form-horizontal" method="POST" action="{{ url('register') }}">
              {{ csrf_field() }}
            <fieldset id="account">
              <legend>Your Personal Details</legend>
               <div class="form-group {{ $errors->has('account_type') ? ' has-error' : '' }}">
                <label for="input-country" class="col-sm-2 control-label">Account Type</label>
                <div class="col-sm-10">
                  <select class="form-control" id="account_type" name="account_type">
                        <option value="{{ old('account_type') ? old('account_type') : '' }}">{{ old('account_type') ? old('account_type') : '--Please select--' }}</option>
                    <option value="Student">Student</option>
                    <option value="Staff">Staff</option>
                  </select>
                  @if ($errors->has('account_type'))
                      <span class="help-block alert alert-danger">
                          <strong>{{ $errors->first('account_type') }}</strong>
                      </span>
                  @endif


                </div>
              </div>

            <div class="form-group {{ $errors->has('enrollment') ? ' has-error' : '' }}">
                <label for="input-Enrollment" class="col-sm-2 control-label">Enrollment</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="enrollment" placeholder="Staff can enter Staff ID" value="{{ old('enrollment') }}" name="enrollment">
                  @if ($errors->has('enrollment'))
                      <span class="help-block alert alert-danger">
                          <strong>{{ $errors->first('enrollment') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">
                <label for="input-firstname" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="firstname" placeholder="First Name" value="{{ old('firstname') }}" name="firstname">
                  @if ($errors->has('firstname'))
                      <span class="help-block alert alert-danger">
                          <strong>{{ $errors->first('firstname') }}</strong>
                      </span>
                  @endif
                </div>

              </div>


            <div class="form-group {{ $errors->has('lastname') ? ' has-error' : '' }}">
                <label for="input-lastname" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="lastname" placeholder="Last Name" value="{{ old('lastname') }}" name="lastname">
                  @if ($errors->has('lastname'))
                      <span class="help-block alert alert-danger">
                          <strong>{{ $errors->first('lastname') }}</strong>
                      </span>
                  @endif

                </div>
              </div>


              <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="input-email" class="col-sm-2 control-label">E-Mail</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" placeholder="E-Mail" value="{{ old('email') }}" name="email">
                  @if ($errors->has('email'))
                      <span class="help-block alert alert-danger">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif

                </div>
              </div>


              <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}">
                <label for="input-telephone" class="col-sm-2 control-label">Mobile</label>
                <div class="col-sm-10">
                  <input type="tel" class="form-control" id="mobile" placeholder="Mobile" value="{{ old('mobile') }}" name="mobile">
                  @if ($errors->has('mobile'))
                      <span class="help-block alert alert-danger">
                          <strong>{{ $errors->first('mobile') }}</strong>
                      </span>
                  @endif

                </div>
              </div>


               <div class="form-group {{ $errors->has('department') ? ' has-error' : '' }}">
                <label for="department" class="col-sm-2 control-label">Department</label>
                <div class="col-sm-10">
                  <select class="form-control" id="department" name="department"  >
                        <option value="{{ old('department') ? old('department') : '' }}">{{ old('department') ? old('department') : '--Please select--' }}</option>
                    <option value="Computer Science &amp; Enginnering">Computer Science &amp; Enginnering</option>
                    <option value="IT Enginnering">IT Enginnering</option>
                    <option value="Mechanical Enginnering">Mechanical Enginnering</option>
                  </select>
                  @if ($errors->has('department'))
                      <span class="help-block alert alert-danger">
                          <strong>{{ $errors->first('department') }}</strong>
                      </span>
                  @endif

                </div>
              </div>

            </fieldset>
            <fieldset id="address">
              <legend>Your Address</legend>

               <div class="form-group {{ $errors->has('campustick') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <input type="checkbox" name="campustick" {{ old('campustick') ? 'checked' : '' }} >
                  Tick if you Residing at Campur Hostel
                  @if ($errors->has('campustick'))
                      <span class="help-block alert alert-danger">
                          <strong>{{ $errors->first('campustick') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                <label for="input-address-1" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="address" placeholder="Address " value="{{ old('address') }}" name="address">
                  @if ($errors->has('address'))
                      <span class="help-block alert alert-danger">
                          <strong>{{ $errors->first('address') }}</strong>
                      </span>
                  @endif

                </div>
              </div>

              <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                <label for="input-city" class="col-sm-2 control-label">City</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="input-city" placeholder="City" value="{{ old('city') }}" name="city">
                  @if ($errors->has('city'))
                      <span class="help-block alert alert-danger">
                          <strong>{{ $errors->first('city') }}</strong>
                      </span>
                  @endif

                </div>
              </div>
              <div class="form-group {{ $errors->has('postcode') ? ' has-error' : '' }}">
                <label for="input-postcode" class="col-sm-2 control-label">Post Code</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="postcode" placeholder="Post Code" value="{{ old('postcode') }}" name="postcode">
                  @if ($errors->has('postcode'))
                      <span class="help-block alert alert-danger">
                          <strong>{{ $errors->first('postcode') }}</strong>
                      </span>
                  @endif

                </div>
              </div>

            </fieldset>

            <div class="buttons">
              <div class="pull-right">
                <input type="checkbox" name="agree">
                &nbsp;I have read and agree to the <a class="agree" href="#"><b>Privacy Policy</b></a> &nbsp;

                @if ($errors->has('agree'))
                    <span class="help-block alert alert-danger">
                        <strong>{{ $errors->first('agree') }}</strong>
                    </span>
                @endif

                <input type="submit" class="btn btn-primary" value="Continue">
              </div>
            </div>
          </form>
        </div>
        <!--Middle Part End -->

      </div>
    </div>
  </div>


  @endsection
