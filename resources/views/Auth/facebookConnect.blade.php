@extends('layouts.cmsMaster')
@section('title', 'Connect to Facebook | Portalic.us')
@section('meta_description', '')
@section('meta_keyword', '')

@section('content')
<div class="bannar-main">
    <div class="wrapper text-center">
        <!--login content-->
        <div class="loginMainContainer">
            <div class="loginContentHolder">
                @if(session('errormessage'))
                <div class="alert alert-danger alert-dismissible">
                    {{ session('errormessage') }}
                </div>
                @endif

                <form method="post" action="{{url('auth/login')}}" name="loginForm" id="loginForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <ul>
                        <li>
                            <h1>Connect to Facebook</h1>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <input type="email" value="{!!old('email')!!}" class="txtbx email" name="email" placeholder="Email"/>
                            @if($errors->has('email'))
                            <span class="has-error">{!!$errors->first('email')!!}</span>
                            @endif
                        </li>
                        <li>
                            <input type="password" maxlength="15" class="password" id="password" name="password" placeholder="Password"/>
                            @if($errors->has('password'))
                            <span class="has-error">{!!$errors->first('password')!!}</span>
                            @endif
                        </li>
                        <li class="SigninBtn hvr-shrink">
                            <input type="hidden" name="fbAuthId" value="{{ $fbAuthId }}" readonly="readonly">
                            <input class="loginBtn" type="submit" value="Sign In">
                        </li>
                    </ul>
                </form>
            </div>
        </div>
        <!--login content end-->
    </div>
</div> <!-- .bannar-main -->
@endsection

@section('script')
<script>

</script>
@endsection
