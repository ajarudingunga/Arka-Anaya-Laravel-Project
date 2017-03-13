@extends('layouts.master')

@section('content')

    <div id="container">
      <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
          <li><a href=""><i class="fa fa-home"></i></a></li>
          <li><a href="">Account</a></li>
          <li><a href="">Forget Password</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
          <!--Middle Part Start-->
          <div id="content" class="col-sm-9">

            <div class="row">
              <div class="col-sm-6">
              </div>
              <div class="col-sm-6">
                <h2 class="subtitle">Forget Password</h2>
                <p><strong>Don't worry if you forget password. Just insert registerd Email address for password reset link.</strong></p>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="" action="{{url('password/email')}}" method="post">
                  {{csrf_field()}}
                  <input type="hidden" name="role" value="user" />
                  <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="control-label" for="input-email">E-Mail Address</label>
                    <input type="text" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" class="form-control" />

                    @if ($errors->has('email'))
                        <span class="help-block alert alert-danger">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                  </div>
                  <input type="submit" value="Send Password Reset Link" class="btn btn-primary" />
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
</div> <!-- .bannar-main -->
@endsection
