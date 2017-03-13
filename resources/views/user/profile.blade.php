@extends('layouts.master') @section('content')

<div id="container">
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i></a></li>
            <li><a href="{{url('user/my-account')}}">Account</a></li>
            <li><a href="#">MyProfile</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Middle Part Start-->

            @if(Session::has('message'))
                <div class="alert {{ Session::get('alert-class') }} fade-in col-sm-3" id="alert" style="position:fixed;top:10px; z-index:10000; width: 300px;margin: auto;left: 0;right:0;">
                    <a class="close" data-dismiss="alert" aria-label="close">×</a>
                    {{ Session::get('message') }}
                </div>
            @endif


            <div class="col-sm-9" id="content">
                <h1 class="title">My Profile</h1>

                <form class="form-horizontal" method="POST" action="{{ url('user/update-profile') }}">
                    {{ csrf_field() }}
                    <fieldset id="account">
                        <legend>Your Personal Details</legend>
                        <div class="form-group {{ $errors->has('account_type') ? ' has-error' : '' }}">
                            <label for="input-country" class="col-sm-2 control-label">Account Type</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="account_type" placeholder="Account Type" value="{{ $userDetails->user_type }}" name="account_type" disabled>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('enrollment') ? ' has-error' : '' }}">
                            <label for="input-Enrollment" class="col-sm-2 control-label">Enrollment</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="enrollment" value="{{ $user->enrollment }}" name="enrollment" disabled> @if ($errors->has('enrollment'))
                                <span class="help-block alert alert-danger">
                          <strong>{{ $errors->first('enrollment') }}</strong>
                      </span> @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="input-firstname" class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="firstname" placeholder="First Name" value="{{  $userDetails->user_firstname }}" name="firstname">
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
                                <input type="text" class="form-control" id="lastname" placeholder="Last Name" value="{{ $userDetails->user_lastname}}" name="lastname"> @if ($errors->has('lastname'))
                                <span class="help-block alert alert-danger">
                          <strong>{{ $errors->first('lastname') }}</strong>
                      </span> @endif

                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="input-email" class="col-sm-2 control-label">E-Mail</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" placeholder="E-Mail" value="{{$user->email }}" name="email"> @if ($errors->has('email'))
                                <span class="help-block alert alert-danger">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span> @endif

                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="input-telephone" class="col-sm-2 control-label">Mobile</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" id="mobile" placeholder="Mobile" value="{{ $userDetails->user_mobileno }}" name="mobile"> @if ($errors->has('mobile'))
                                <span class="help-block alert alert-danger">
                          <strong>{{ $errors->first('mobile') }}</strong>
                      </span> @endif

                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="department" class="col-sm-2 control-label">Department</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="department" name="department">
                                    <option value="{{$userDetails->user_department}}">{{$userDetails->user_department}}</option>
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

                        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="input-address-1" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="address" placeholder="Address " value="{{$userDetails->user_address}}" name="address"> @if ($errors->has('address'))
                                <span class="help-block alert alert-danger">
                          <strong>{{ $errors->first('address') }}</strong>
                      </span> @endif

                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="input-city" class="col-sm-2 control-label">City</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-city" placeholder="City" value="{{ $userDetails->user_city  }}" name="city"> @if ($errors->has('city'))
                                <span class="help-block alert alert-danger">
                          <strong>{{ $errors->first('city') }}</strong>
                      </span> @endif

                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('postcode') ? ' has-error' : '' }}">
                            <label for="input-postcode" class="col-sm-2 control-label">Post Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="postcode" placeholder="Post Code" value="{{$userDetails->user_postcode }}" name="postcode"> @if ($errors->has('postcode'))
                                <span class="help-block alert alert-danger">
                          <strong>{{ $errors->first('postcode') }}</strong>
                      </span> @endif

                            </div>
                        </div>

                    </fieldset>

                    <div class="buttons">
                        <div class="pull-right">
                             @if ($errors->has('agree'))
                            <span class="help-block alert alert-danger">
                                <strong>{{ $errors->first('agree') }}</strong>
                            </span>
                            @endif

                            <input type="submit" class="btn btn-primary" value="Update">
                        </div>
                    </div>
                </form>
            </div>
            <!--Middle Part End -->

        </div>
    </div>
</div>

<script>
    $("#alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#alert").slideUp(500);
});

</script>

@endsection
