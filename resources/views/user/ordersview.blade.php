@extends('layouts.master')

@section('content')

    <div class="container" style="padding-top:30px;">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="{{ url('')}}"><i class="fa fa-home"></i></a></li>
        <li><a href="{{ url('')}}">Account</a></li>
        <li><a>Orders</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div class="col-sm-9" id="content">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">Your Orders</h4>
                </div>

                <div id="collapse-coupon" class="panel-collapse collapse in">
                  <div class="panel-body">
                    @foreach ($orders as $key => $order)
                     <div class="panel panel-default">
                         <div class="panel-body">

                             @foreach ($order->cart->items as $key => $item)
                              <label class="col-sm-9 control-label" for="input-coupon" data-toggle="tooltip" title="Name">
                                  <?php
                                    print_r($item['item']->product_name);
                                  ?>
                              </label>
                              <label class="col-sm-1 control-label" for="input-coupon" data-toggle="tooltip" title="Quantity">
                                 {{$item['qty']}}
                              </label>
                              <label class="col-sm-2 control-label" for="input-coupon" style="text-align:right;" data-toggle="tooltip" title="Price">
                                  {{$item['price']}}
                              </label>
                              @endforeach
                         </div>
                         <div class="panel-footer">
                             <div class="col-sm-3">
                                <a data-toggle="tooltip" title="Order ID"># {{$order->id}}</a>
                             </div>
                             <div class="col-sm-3 pull-right" style="text-align:right;">
                                 Total Amount :
                                 <strong>{{$order->cart->totalPrice}}</strong>
                             </div>
                             <div class="clearfix">

                             </div>
                         </div>
                      </div>
                    @endforeach


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
