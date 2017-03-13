@extends('layouts.master')

@section('content')

    <div id="container">
      <div class="container">

        <div class="row">
          <!--Middle Part Start-->
          <div id="content" class="col-sm-9">

            <div class="row">
              <div class="col-sm-6">
              </div>
              <div class="col-sm-6">
                <h2 class="subtitle">Reset Password</h2>

                @if (session('status'))
                <div class="alert alert-success alert-dismissible">
                      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                      {{ session('status') }}
                    </div>
                @endif

                <form class="" action="{{url('/user/password/reset')}}" method="post">
                  {{csrf_field()}}
                  <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="control-label" for="input-email">E-Mail Address</label>
                    <input type="text" name="email" value="{{ $email or old('email') }}" placeholder="E-Mail Address" class="form-control" />

                    @if ($errors->has('email'))
                        <span class="help-block alert alert-danger">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>

    	 <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="control-label" for="input-email">Password</label>
    		<input id="password" type="password" class="form-control" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block alert alert-danger">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>


	             <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="control-label" for="input-email">Confirm Password</label>
                   <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    @if ($errors->has('email'))
                        <span class="help-block alert alert-danger">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                 </div>

                  <input type="submit" value="Reset Password" class="btn btn-primary" />
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
</div> <!-- .bannar-main -->
@endsection
