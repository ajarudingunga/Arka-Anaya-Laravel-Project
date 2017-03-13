@extends('layouts.master')
@section('content')

  <div id="container">
    <div class="container">
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-xs-12">


            @if(Session::has('message'))
                <div class="alert {{ Session::get('alert-class') }} fade-in col-sm-3" id="alert" style="position:fixed;top:10px; z-index:10000; width: 300px;margin: auto;left: 0;right:0;">
                    <a class="close" data-dismiss="alert" aria-label="close">×</a>
                    {{ Session::get('message') }}
                </div>
            @endif



          <div class="row">
            <div class="col-sm-8">
              <!-- Slideshow Start-->
              <div class="slideshow single-slider owl-carousel">
                <div class="item"> <a href="#"><img class="img-responsive" src="{{ URL::asset('/resources/assets/user/image/slider/image-1-750x400.jpg')}}" alt="banner 1" /></a></div>
                <div class="item"> <a href="#"><img class="img-responsive" src="{{ URL::asset('/resources/assets/user/image/slider/image-2-750x400.jpg')}}" alt="banner 2" /></a></div>
                <div class="item"> <a href="#"><img class="img-responsive" src="{{ URL::asset('/resources/assets/user/image/slider/image-3-750x400.jpg')}}" alt="banner 3" /></a></div>
              </div>
              <!-- Slideshow End-->
            </div>
            <div class="col-sm-4 pull-right flip">
              <div class="marketshop-banner">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <a href="#"><img title="sample-banner1" alt="sample-banner1" src="{{ URL::asset('/resources/assets/user/image/banner/sp-small-banner-360x185.jpg')}}"></a></div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <a href="#"><img title="sample-banner" alt="sample-banner" src="{{ URL::asset('/resources/assets/user/image/banner/sp-small-banner1-360x185.jpg')}}"></a></div>
                </div>
              </div>
            </div>
          </div>

          <!-- Bestsellers Product Start-->
          <h3 class="subtitle">Bestsellers</h3>
          <div class="owl-carousel product_carousel">


        @foreach ($feturedProduct = Helper::getFeaturedProducts() as $feturedProduct)
            <div class="product-thumb clearfix">
              <div class="image" style=""><a href="{{url('user/product', ['id' => $feturedProduct->id])}}"><img src="{{ URL::asset('/resources/uploads/avatars/'.$feturedProduct->product_image_url)}}" alt="{{$feturedProduct->product_name}}" title="{{$feturedProduct->product_name}}" class="img-responsive" style="object-fit:cover;min-height: 200px;" /></a>
              </div>

              <div class="caption">
                <h4><a href="{{url('user/product', ['id' => $feturedProduct->id])}}">{{$feturedProduct->product_name}}</a></h4>
                <p class="price">
                     <span class="price-new"><i class="fa fa-inr"> </i> {{$feturedProduct->product_price}} </span>
                     <span class="price-old"><i class="fa fa-inr"> </i> {{$feturedProduct->product_old_price}} </span>

                     @if ($feturedProduct->product_type == "Veg" )
                         <span class="saving">Veg</span>
                     @elseif ($feturedProduct->product_type == "Jain")
                              <span class="saving" style="background: #f0ad4e;">Jain</span>
                     @elseif ($feturedProduct->product_type == "n-Veg")
                              <span class="saving"  style="background: #d9534f;">n-Veg</span>
                     @endif

                 </p>
                <div class="rating">
                    <span class="fa fa-stack">
                        <i class="fa fa-star fa-stack-2x"></i>
                        <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                        <i class="fa fa-star fa-stack-2x"></i>
                        <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                        <i class="fa fa-star fa-stack-2x"></i>
                        <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                        <i class="fa fa-star fa-stack-2x"></i>
                        <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                        <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                 </div>
              </div>

              <div class="button-group">
                <a href="{{url('/addtocart', ['id' => $feturedProduct->id])}}"><button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                <div class="add-to-links"></a>

                  <a href="{{url('/addToWishlist', ['id' => $feturedProduct->id])}}"><button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i></button></a>

                </div>
              </div>
            </div>
        @endforeach

          </div>
          <!-- Featured Product End-->

          <!-- Banner Start -->
          <div class="marketshop-banner">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <a href="#"><img title="1 Block Banner" alt="1 Block Banner" src="{{ URL::asset('/resources/assets/user/image/banner/1blockbanner-1140x75.jpg')}}"></a></div>
            </div>
          </div>
          <!-- Banner End -->
          <!-- Brand Logo Carousel Start-->
          <div id="carousel" class="owl-carousel nxt">
            @foreach ($randomImg = Helper::getRandomPic() as $randomImg)
                <div class="item text-center"> <a href="{{url('user/product', ['id' => $randomImg->id])}}"><img src="{{ URL::asset('/resources/uploads/avatars/'.$randomImg->product_image_url)}}" alt="Palm" class="img-responsive" / style="width:100px;height:100px;object-fit:cover;"></a> </div>
            @endforeach
          </div>
          <!-- Brand Logo Carousel End -->
        </div>

        <!--Middle Part End-->
      </div>
    </div>
  </div>

  <script>
      $("#alert").fadeTo(2000, 500).slideUp(500, function(){
      $("#alert").slideUp(500);
  });

  </script>
@stop