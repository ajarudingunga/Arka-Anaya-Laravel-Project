<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.cmsHeaderInc')
</head>
<body>
    <div id="main">
        @include('layouts.cmsHeader')
            @yield('content')
        @include('layouts.cmsFooter')
    </div>
    @include('layouts.cmsFooterInc')
</body>
</html>
