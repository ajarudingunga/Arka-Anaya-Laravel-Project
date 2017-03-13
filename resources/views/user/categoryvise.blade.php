@extends('layouts.master')
@section('content')


    <div id="container">
      <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i></a></li>
          <li><a href="#">{{ $name = Helper::getCategoryName($id) }} </a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
          <!--Left Part Start -->
          <aside id="column-left" class="col-sm-3 hidden-xs">
            <h3 class="subtitle">Categories</h3>

            <div class="box-category">
              <ul id="cat_accordion">
                @foreach ($categoryname = Helper::getAllCategory() as $categoryname)
                    <li><a href="{{url('user/category', ['id' => $categoryname->id])}}">{{$categoryname->category_name}}</a>
                @endforeach
              </ul>
            </div>


            <h3 class="subtitle">Bestsellers</h3>
            <div class="side-item">

            @foreach ($feturedProduct = Helper::getFeaturedProducts() as $feturedProduct)
              <div class="product-thumb clearfix">
                <div class="image"><a href="{{url('user/product', ['id' => $feturedProduct->id])}}"><img src="{{URL::asset('/resources/uploads/avatars/'.$feturedProduct->product_image_url)}}" alt="" title="" class="img-responsive" /></a></div>
                <div class="caption">
                  <h4><a href="{{url('user/product', ['id' => $feturedProduct->id])}}">{{$feturedProduct->product_name}}</a></h4>

                  <p class="price">
                      <span class="price-new"><i class="fa fa-inr"> </i> {{$feturedProduct->product_price}}</span>
                      <span class="price-old"><i class="fa fa-inr"> </i> {{$feturedProduct->product_old_price}}</span>

                      @if ($feturedProduct->product_type == "Veg" )
                          <span class="saving">Veg</span>
                      @elseif ($feturedProduct->product_type == "Jain")
                               <span class="saving" style="background: #f0ad4e;">Jain</span>
                      @elseif ($feturedProduct->product_type == "n-Veg")
                               <span class="saving"  style="background: #d9534f;">n-Veg</span>
                      @endif

                  </p>
                </div>
              </div>
             @endforeach

            </div>


          </aside>
          <!--Left Part End -->
          <!--Middle Part Start-->
          <div id="content" class="col-sm-9">
            <h1 class="title">{{ $name = Helper::getCategoryName($id) }}</h1>
            <div class="product-filter">
              <div class="row">
                <div class="col-md-4 col-sm-5">
                  <div class="btn-group">
                    <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"></button>
                    <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"></button>
                  </div>
                   </div>
                <div class="col-sm-2 text-right">
                  <label class="control-label" for="input-sort"></label>
                </div>
                <div class="col-md-3 col-sm-2 text-right">

                </div>
                <div class="col-sm-1 text-right">
                  <label class="control-label" for="input-limit"></label>
                </div>
                <div class="col-sm-2 text-right">
                </div>
              </div>
            </div>
            <br />
            <div class="row products-category">

            @foreach ($products as $product)
              <div class="product-layout product-list col-xs-12">
                <div class="product-thumb">
                  <div class="image"  style=""><a href="{{url('user/product', ['id' => $product->id])}}"><img src="{{URL::asset('/resources/uploads/avatars/'.$product->product_image_url)}}" alt="{{ $product->product_name}}" title="{{ $product->product_name}}"  class="img-responsive" style="min-height: 200px; max-height:200px; object-fit:cover; " />
                  </a>
                    </div>
                  <div>
                    <div class="caption">
                      <h4><a href="{{url('user/product', ['id' => $product->id])}}"> {{ $product->product_name}}" </a></h4>
                      <p class="description"> </p>
                      <p class="price">
                          <span class="price-new"><i class="fa fa-inr"> </i> {{ $product->product_price}}</span>
                          <span class="price-old"> <i class="fa fa-inr"> </i> {{ $product->product_old_price}}</span>

                          @if ($product->product_type == "Veg" )
                              <span class="saving">Veg</span>
                          @elseif ($product->product_type == "Jain")
                                   <span class="saving" style="background: #f0ad4e;">Jain</span>
                          @elseif ($product->product_type == "n-Veg")
                                   <span class="saving"  style="background: #d9534f;">n-Veg</span>
                          @endif

                      </p>
                    </div>
                    <div class="button-group">
                      <a href="{{url('/addtocart', ['id' => $product->id])}}"><button class="btn-primary" type="button"><span>Add to Cart</span></button></a>
                      <div class="add-to-links">
                        <a href="{{url('/addToWishlist', ['id' => $product->id])}}" style="color:black;"><button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i> <span>Add to Wish List</span>
                        </button></a>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
                     @endforeach
            </div>
            <div class="row">
              <div class="col-sm-6 text-left">
                  {!! $products->render() !!}
              </div>

            </div>
          </div>
          <!--Middle Part End -->
        </div>
      </div>
    </div>



@stop
