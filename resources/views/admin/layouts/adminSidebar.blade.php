
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ URL::asset('/resources/assets/admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Admin</p>

      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->

    <ul class="sidebar-menu">
      <li class="header"></li>
      <li class="@if(Request::is('admin/userRequest')) active @endif treeview">
        <a href="{{url('admin/userRequest')}}">
          <i class="fa fa-users"></i> <span>User Requests</span>
           <span class="pull-right-container">
            <span class="label label-primary pull-right">{{$variable = Helper::getCountRequest()}}</span>
          </span>
        </a>

      </li>

      <li class="@if(Request::is('admin/recharge')) active @endif treeview">
        <a href="{{url('admin/recharge')}}">
          <i class="fa fa-rupee"></i>
          <span>Recharge-Center</span>
          <span class="pull-right-container">

          </span>
        </a>
      </li>

      <li class="@if(Request::is('admin/users')) active @endif treeview">
        <a href="#">
          <i class="fa fa-user-md"></i>
          <span>Users</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="@if(Request::is('admin/users')) active @endif">
              <a href="{{url('admin\users')}}"><i class="fa fa-circle-o"></i> View All Users</a>
          </li>
        </ul>
      </li>


      <li class="@if(Request::is('admin/cuisine') ||Request::is('admin/categories')) active @endif treeview">
        <a href="#">
          <i class="fa fa-sitemap"></i>
          <span>Food Categories</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="@if(Request::is('admin/cuisine')) active @endif">
              <a href="{{url('admin\cuisine')}}"><i class="fa fa-circle-o"></i> Daily Cuisine</a></li>
          <li class="@if(Request::is('admin/categories')) active @endif">
              <a href="{{url('admin\categories')}}"><i class="fa fa-circle-o"></i> Main Category</a></li>
        </ul>
      </li>


      <li class="@if(Request::is('admin/product')) active @endif treeview">
        <a href="{{url('admin\product')}}">
          <i class="fa fa-truck"></i>
          <span>Products</span>
          <span class="pull-right-container">
           <span class="label label-success pull-right">{{$variable = Helper::getCountProducts()}} </span>
         </span>
        </a>
      </li>

      <li class="@if(Request::is('admin/all-orders')||Request::is('admin/all-orders-payments')) active @endif treeview">
        <a href="#">
          <i class="fa fa-pie-chart"></i>
          <span>Orders</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right "></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="@if(Request::is('admin/all-orders')) active @endif">
              <a href="{{url('admin\all-orders')}}"><i class="fa fa-circle-o"></i>All Order</a></li>
          <li class="@if(Request::is('admin/all-orders-payments')) active @endif">
              <a href="{{url('admin\all-orders-payments')}}"><i class="fa fa-circle-o"></i>Orders Payments</a></li>
         </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
