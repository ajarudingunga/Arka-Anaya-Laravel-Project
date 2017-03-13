<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<base href="{{URL::asset('/')}}" target="_top">
<link href="{{URL::asset('/resources/assets/user/image/favicon.png')}}" rel="icon" />
<title>Arka Anaya</title>
<!-- CSS Part Start-->
@include('partials.user.css')
<!-- CSS Part End-->
</head>
<body>
<div class="wrapper-wide">
@include('partials.user.header')


@yield('content')

@include('partials.user.footer')
</div>
@include('partials.user.js')
</body>
</html>
