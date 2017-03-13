<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Arka-Anaya Admin</title>

<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

@include('admin.layouts.adminCss')

</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('admin.layouts.adminHeader')
        @include('admin.layouts.adminSidebar')

        @yield('content')

        @include('admin.layouts.adminFooter')
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Create the tabs -->
          <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          </ul>
          <!-- Tab panes -->
        </aside>
        <div class="control-sidebar-bg"></div>
    </div>
</body>
    @include('admin.layouts.adminJS')
</html>
