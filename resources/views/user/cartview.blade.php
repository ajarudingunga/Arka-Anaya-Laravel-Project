@extends('layouts.master')

@section('content')

    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-home"></i></a></li>
        <li><a href="">Shopping Cart</a></li>

      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Shopping-cart &amp; Checkout</h1>
          <div class="row">
              <div class="col-sm-12">
                  @if(Session::has('message'))
                  <div class="alert {{ Session::get('alert-class') }} fade-in" id="alert">
                      <a class="close" data-dismiss="alert" aria-label="close">×</a>
                      {{ Session::get('message') }}
                  </div>
                  @endif
              </div>
            <div class="col-sm-12">
              <div class="row">

                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-shopping-cart"></i> Shopping cart</h4>
                    </div>
                    @if (Session::get('cart')->totalQty != "0")
                        <div class="panel-body">

                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <td class="text-center">Image</td>
                                <td class="text-left">Product Name</td>
                                <td class="text-left">Quantity</td>
                                <td class="text-right">Unit Price</td>
                                <td class="text-right">Total</td>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $counttot = 0;$totalBill=0; ?>
                            @foreach ($products as $key => $product)

                                <tr>
                                    <td class="text-center">
                                        <a href="product.html">
                                            <img src="{{URL::asset('/resources/uploads/avatars/'.$products[$key]['item']->product_image_url)}}" alt="" title="" class="img-thumbnail" style="width:50px;height:50px; object-fit:cover">
                                        </a>
                                    </td>
                                    <td class="text-left">
                                        <a href=""> {{$products[$key]['item']->product_name}}</a>
                                    </td>

                                    <td class="text-left">
                                        <div class="input-group btn-block" style="max-width: 200px;">


                                            <input type="text" name="quantity" value="{{$products[$key]['qty']}}" class="form-control" disabled="true">
                                            <span class="input-group-btn">

                                                <a href="{{url('/incrementCart', ['id' => $products[$key]['item']->id])}}"><button type="submit" data-toggle="tooltip" title="Increment Quantity" class="btn btn-primary">
                                                <i class="fa fa-plus"></i>
                                                </button></a>

                                                <a href="{{url('/decrementCart', ['id' => $products[$key]['item']->id])}}"><button type="submit" data-toggle="tooltip" title="Decrement Quantity" class="btn btn-primary">
                                                <i class="fa fa-minus"></i>
                                                </button></a>

                                                <a href="{{url('/removeItemCart', ['id' => $products[$key]['item']->id])}}"><button type="button" data-toggle="tooltip" title="Remove Whole Item" class="btn btn-danger" onClick=""><i class="fa fa-times-circle"></i></button></a>
                                            </span>
                                        </div>
                                    </td>

                                    <td class="text-right"> <i class="fa fa-inr"> </i> {{$products[$key]['item']->product_price}} </td>
                                    <td class="text-right"><i class="fa fa-inr"> </i>
                                        <?php
                                        echo $products[$key]['item']->product_price * $products[$key]['qty'];

                                        $totalBill += $products[$key]['item']->product_price * $products[$key]['qty'];
                                        ?>
                                    </td>
                                        <?php $counttot += $products[$key]['qty'] ; ?>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                  <td class="text-right" colspan="2"><strong>Total Quntity</strong></td>
                                  <td class="text-right">{{$counttot}}</td>
                                </tr>
                              <tr>
                                <td class="text-right" colspan="2"><strong>Total:</strong></td>
                                <td class="text-right"  colspan="3"><strong><h1>Rs. {{$totalBill}}</h1> </strong></td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>

                        <div class="buttons">
                          <div class="pull-right">

                              <a href="{{url('/makeOrder')}}"><button type="button" class="btn btn-primary" >Confirm Order</button></a>

                          </div>
                        </div>
                      </div>
                    @else
                        <h3 class="text-center"> Cart is Empty</h3>
                    @endif
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!--Middle Part End -->
      </div>
    </div>

    <script>
        $("#alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#alert").slideUp(500);
    });
    </script>

@endsection
