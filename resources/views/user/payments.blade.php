@extends('layouts.master')

@section('content')

<div class="container" style="padding-top:30px;">
  <!-- Breadcrumb Start-->
  <ul class="breadcrumb">
    <li><a href="{{ url('')}}"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ url('')}}">Account</a></li>
    <li><a>Payments</a></li>
  </ul>
  <!-- Breadcrumb End-->
  <div class="row">
    <!--Middle Part Start-->
    <div class="col-sm-9" id="content">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">Your Transactions</h4>
            </div>

            <div id="collapse-coupon" class="panel-collapse collapse in">
              <div class="panel-body">
                  <table class="table table-hover">
                      <th>Transaction ID</th>
                      <th>Purchased at</th>
                      <th>Amount</th>
                      <th>For Order</th>
                      @foreach ($payments as $key => $payment)
                      <tr>
                          <td>#{{$payment->id}}</td>
                          <td>{{$payment->created_at}}</td>
                          <td>{{$payment->amount}}</td>
                          <td>#{{$payment->order_id}}</td>
                      </tr>
                      @endforeach
                  </table>
            </div>
            <div class="panel-footer">

            </div>

          </div>
        </div>
    <!--Middle Part End -->

    <!--Right Part Start -->
    </div>
    <aside id="column-right" class="col-sm-3 hidden-xs">
      <h3 class="subtitle">Account</h3>
      <div class="list-group">
        <ul class="list-item">
        <li><a href="{{url('/user/my-account')}}">My-Account</a></li>
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
