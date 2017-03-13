@extends('layouts.master')

@section('content')

    <div class="container" style="padding-top:20px;">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href=""><i class="fa fa-home"></i></a></li>
        <li><a href="">Account</a></li>
        <li><a href="">My Wish List</a></li>
      </ul>
      <!-- Breadcrumb End-->

          @if(Session::has('message'))
              <div class="alert {{ Session::get('alert-class') }} fade-in col-sm-3" id="alert" style="position:fixed;top:10px; z-index:10000; width: 300px;margin: auto;left: 0;right:0;">
                  <a class="close" data-dismiss="alert" aria-label="close">×</a>
                  {{ Session::get('message') }}
              </div>
          @endif

      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">My Wish List</h1>
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td class="text-center">Image</td>
                  <td class="text-left">Product Name</td>
                  <td class="text-right">Unit Price</td>
                  <td class="text-right">Action</td>
                </tr>
              </thead>
              <tbody>
           @foreach ($wishlistItems as $key => $wishlistItem)
                <tr>
                  <td class="text-center"><a href="product.html"><img src="{{URL::asset('/resources/uploads/avatars/'.$wishlistItem->product_image_url)}}" alt="" title="" style="width:50px;height:50px;object-fit:cover;" /></a></td>
                  <td class="text-left"><a href="#">{{$wishlistItem->product_name}}</a></td>
                  <td class="text-right"><div class="price"> {{$wishlistItem->product_price}} </div>
                  </td>
                  <td class="text-right">

                    <a href="{{url('/user/my-wishlist/addtocartandremove', ['id' => $wishlistItem->id])}}"><button class="btn btn-primary" title="" data-toggle="tooltip" onClick="cart.add('48');" type="button" data-original-title="Add to Cart"><i class="fa fa-shopping-cart"></i></button></a>

                    <a class="btn btn-danger" title="" data-toggle="tooltip" href="{{url('/user/my-wishlist/remove', ['id' => $wishlistItem->id])}}" data-original-title="Remove"><i class="fa fa-times"></i></a></td>
                </tr>
             @endforeach

              </tbody>
            </table>
          </div>
        </div>
        <!--Middle Part End -->
      </div>
    </div>

</div>



    <script>
        $("#alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#alert").slideUp(500);
    });
    </script>

@endsection
