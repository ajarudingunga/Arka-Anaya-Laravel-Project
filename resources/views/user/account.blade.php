@extends('layouts.master')

@section('content')

    <div class="container" style="padding-top:30px;">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="{{ url('')}}"><i class="fa fa-home"></i></a></li>
        <li><a>Account</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div class="col-sm-9" id="content">

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">Account Balance</h4>
                </div>

                <div id="collapse-coupon" class="panel-collapse collapse in">
                  <div class="panel-body">
                    <label class="col-sm-6 control-label" for="input-coupon">
                        <h2>Your Balance is</h2>
                    </label>
                    <label class="col-sm-3 control-label" for="input-coupon">
                        <h2 style="color:green;"><i class="fa fa-inr">. </i> {{$balance = Helper::getUserBalace()}}</h2>
                    </label>

                  </div>
                </div>
              </div>

             
        </div>
        <!--Middle Part End -->
        <!--Right Part Start -->
        <aside id="column-right" class="col-sm-3 hidden-xs">
          <h3 class="subtitle">Account</h3>
          <div class="list-group">
            <ul class="list-item">
              <li><a href="{{url('/user/profile')}}">Profile</a></li>
              <li><a href="{{url('/user/my-wishlist')}}">Wishlist</a></li>
              <li><a href="{{url('/user/my-orders')}}">Orders</a></li>
              <li><a href="{{url('/user/my-transactions')}}">Transactions</a></li>
            </ul>
          </div>
        </aside>
        <!--Right Part End -->
      </div>
    </div>

@endsection
