@extends('layouts.master')
@section('content')
    <div id="container">
        <div class="container">
            <!-- Breadcrumb Start-->
            <ul class="breadcrumb">
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="{{url('')}}" itemprop="url"><span itemprop="title"><i class="fa fa-home"></i></span></a></li>
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">

                    <a href="{{url('user/category', ['id' => $products->product_category_id])}}" itemprop="url">
                    <span itemprop="title">{{ $name = Helper::getCategoryName($products->product_category_id) }}</span>
                    </a></li>
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a  itemprop="url"><span itemprop="title">{{$products->product_name}}</span></a></li>
            </ul>

            <!-- Breadcrumb End-->
            <div class="row">
                <div id="content" class="col-sm-12">
                    <div itemscope itemtype="http://schema.org/Product">
                        <h1 class="title" itemprop="name">{{$products->product_name}}</h1>
                        <div class="row product-info">
                            <div class="col-sm-6">
                                <div class="image">
                                    <img class="img-responsive" itemprop="image" id="zoom_01" src="{{URL::asset('/resources/uploads/avatars/'.$products->product_image_url)}}"  alt="Product image"  data-zoom-image="{{URL::asset('/resources/uploads/avatars/'.$products->product_image_url)}}" style="height:350px;width:400px;object-fit:cover;" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled description">

                                    <li><b>Product Id:</b> <span itemprop="mpn">{{$products->id}}</span></li>

                                    <li><b></b> <span class="instock">Available</span></li>
                                </ul>
                                <ul class="price-box">
                                    <li class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span class="price-old">&#x20a8;.{{$products->product_old_price}}</span> <span itemprop="price">&#x20a8;. {{$products->product_price}}</span>
                                    </li>
                                    <li></li>

                                </ul>
                                <div id="product">

                                    <div class="cart">
                                        <div>
                                            {{-- <div class="qty">
                                                <label class="control-label" for="input-quantity">Qty</label>
                                                <input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control" />
                                                <a class="qtyBtn plus" href="javascript:void(0);">+</a>
                                                <br />
                                                <a class="qtyBtn mines" href="javascript:void(0);">-</a>
                                                <div class="clear"></div>
                                            </div> --}}
                                            <?php
                                            // $cart = Session::get('cart');
                                            // foreach ($cart->items as $key => $cart) {
                                            //     if ($products->id == $cart['item']->id) {
                                            //         echo "added";
                                            //     }
                                            //     else {
                                            //         echo "not added";
                                            //     }
                                            // }
                                            ?>
                                            <a href="{{url('/addtocart', ['id' => $products->id])}}"><button type="button" id="button-cart" class="btn btn-primary btn-lg">Add to Cart</button></a>


                                        </div>
                                        <div>
                                            <a href="{{url('/addToWishlist', ['id' => $products->id])}}" style="color:black;">
                                            <button type="button" class="wishlist" ><i class="fa fa-heart"></i> Add to Wish List</button>
                                            </a>
                                            <br />


                                        </div>
                                    </div>
                                </div>
                                <div class="rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                                    <meta itemprop="ratingValue" content="0" />
                                    <p><span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x">
                                    </i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span> <a onClick="$('a[href=\'#tab-review\']').trigger('click'); return false;" href="">
                                        <span itemprop="reviewCount">1 reviews</span></a> / <a onClick="$('a[href=\'#tab-review\']').trigger('click'); return false;" href="">Write a review</a></p>
                                </div>
                                <hr>

                            </div>
                        </div>


                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>

                            <li><a href="#tab-review" data-toggle="tab">Reviews (2)</a></li>
                        </ul>
                        <div class="tab-content">
                            <div itemprop="description" id="tab-description" class="tab-pane active">
                                <div>
                                    {{$products->product_description}}
                                </div>
                            </div>
                                                      <div id="tab-review" class="tab-pane">
                                <form class="form-horizontal">
                                    <div id="review">
                                        <div>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 50%;"><strong><span>harvey</span></strong></td>
                                                        <td class="text-right"><span>20/01/2016</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                            <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 50%;"><strong><span>Andrson</span></strong></td>
                                                        <td class="text-right"><span>20/01/2016</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                            <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-right"></div>
                                    </div>
                                    <h2>Write a review</h2>
                                    <div class="form-group required">
                                        <div class="col-sm-12">
                                            <label for="input-name" class="control-label">Your Name</label>
                                            <input type="text" class="form-control" id="input-name" value="" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-12">
                                            <label for="input-review" class="control-label">Your Review</label>
                                            <textarea class="form-control" id="input-review" rows="5" name="text"></textarea>
                                            <div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-12">
                                            <label class="control-label">Rating</label>
                                            &nbsp;&nbsp;&nbsp; <B></B>ad&nbsp;
                                            <input type="radio" value="1" name="rating"> &nbsp;
                                            <input type="radio" value="2" name="rating"> &nbsp;
                                            <input type="radio" value="3" name="rating"> &nbsp;
                                            <input type="radio" value="4" name="rating"> &nbsp;
                                            <input type="radio" value="5" name="rating"> &nbsp;Good
                                        </div>
                                    </div>
                                    <div class="buttons">
                                        <div class="pull-right">
                                            <button class="btn btn-primary" id="button-review" type="button">Continue</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <!--Middle Part End -->
            </div>
        </div>
    </div>

@stop
