<div id="header">
    <!-- Top Bar Start-->

    <nav id="top" class="htop">
        <div class="container">
            <div class="row"> <span class="drop-icon visible-sm visible-xs"><i class="fa fa-align-justify"></i></span>
                <div class="pull-left flip left-top">
                    <div class="links">
                        <ul>
                            <li class="email"><a href="mailto:info@arka-anay.com"><i class="fa fa-envelope"></i>info@arka-anay.com</a></li>

                            @if(Auth::guest())
                            @else
                            <li><a href="{{ url('user/my-wishlist') }}">Wish List ({{ $c= Helper::getWishlistCount()}})</a></li>
                            @endif

                            <li><a href="{{url('/shopping-cart')}}">Checkout</a></li>
                        </ul>
                    </div>
                </div>
                <div id="top-links" class="nav pull-right flip">
                    <ul>

                        @if(Auth::guest())
                        <li><a href="{{ url('login') }}">Login</a></li>
                        <li><a href="{{ url('register') }}">Register</a></li>
                        <li><a href="{{ url('admin') }}">Admin</a></li>
                        @else
                        <li><a href="{{ url('user/my-account') }}">My Account</a></li>
                        <li>
                            <a href="{{url('logout')}}">Logout</a>
                        </li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Top Bar End-->
    <!-- Header Start-->
    <header class="header-row">
        <div class="container">
            <div class="table-container">
                <!-- Logo Start -->
                <div class="col-table-cell col-lg-4 col-md-4 col-sm-12 col-xs-12 inner">
                    <div id="logo">
                        <a href="#"><img class="img-responsive" src="{{ URL::asset('/resources/assets/user/image/logo.png')}}" title="MarketShop" alt="MarketShop" /></a>
                    </div>

                </div>
                <!-- Logo End -->
                <!-- Search Start-->
                <div class="col-table-cell col-lg-5 col-md-5 col-md-push-0 col-sm-6 col-sm-push-6 col-xs-12">
                    <div id="search" class="input-group">
                        <input id="filter_name" type="text" name="search" value="" placeholder="Search" class="form-control input-lg" />
                        <button type="button" class="button-search"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <!-- Search End-->
                <!-- Mini Cart Start-->
                <div class="col-table-cell col-lg-3 col-md-3 col-md-pull-0 col-sm-6 col-sm-pull-6 col-xs-12 inner">
                    <div id="cart">
                        <a href="{{url('/shopping-cart')}}" class="heading dropdown-toggle">
                            <span class=" pull-left flip">
                                <img src="{{ URL::asset('/resources/assets/user/image/cart.png')}}">
                            </span>

                            <span id="cart-total">{{Session::has('cart') ? Session::get('cart')->totalQty : '0'}}
                                  item(s) - <i class="fa fa-inr"> </i> {{Session::has('cart') ? Session::get('cart')->totalPrice : '0'}}
                            </span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <table class="table">
                                    <tbody>
                                        @if(Session::has('cart'))
                                            @foreach ($cartdata=Session::get('cart')as $key => $cartdata)
                                            <tr>
                                                <td class="text-center">
                                                    <a href=""><img class="img-thumbnail" title="Xitefun Causal Wear Fancy Shoes" alt="Image Title" src=""></a>
                                                </td>
                                                <td class="text-left"><a href="#">Xitefun Causal Wear Fancy Shoes</a></td>
                                                <td class="text-right">x 1</td>
                                                <td class="text-right">$902.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-danger btn-xs remove" title="Remove" onClick="" type="button"><i class="fa fa-times"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else

                                        @endif

                                    </tbody>
                                </table>
                            </li>
                            <li>
                                <div>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td class="text-right"><strong>Sub-Total</strong></td>
                                                <td class="text-right">$940.00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right"><strong>Eco Tax (-2.00)</strong></td>
                                                <td class="text-right">$4.00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right"><strong>VAT (20%)</strong></td>
                                                <td class="text-right">$188.00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right"><strong>Total</strong></td>
                                                <td class="text-right">$1,132.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p class="checkout"><a href="#" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> View Cart</a>&nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-primary"><i class="fa fa-share"></i> Checkout</a></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Mini Cart End-->
            </div>
        </div>
    </header>
    <!-- Header End-->
    <!-- Main Menu Start-->
    <nav id="menu" class="navbar">
        <div class="container">
            <div class="navbar-header"> <span class="visible-xs visible-sm"> Menu <b></b></span></div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><a class="home_link" title="Home" href="{{url('/')}}"><span>Home</span></a></li>
                    <li class="dropdown"><a>Food Categories</a>
                        <div class="dropdown-menu">
                            <ul>

                                @foreach ($categoryname = Helper::getAllCategory() as $categoryname)
                                <li><a href="{{url('user/category', ['id' => $categoryname->id])}}">{{$categoryname->category_name}}</a> @endforeach
                            </ul>
                        </div>
                        </li>
                        <li class="menu_brands dropdown"><a href="#">Daily Cuisine</a>
                            <div class="dropdown-menu">


                                @foreach (Helper::getCuisine() as $cuisinename)

                                <div class="col-lg-1 col-md-2 col-sm-3 col-xs-6">
                                    <a href="{{url('user/cuisine', ['id' => $cuisinename->product_id])}}">
                                        <img src="{{ URL::asset('/resources/uploads/avatars/'.$cuisinename->product_image_url)}}" title="{{$cuisinename->product_description}}" alt="{{$cuisinename->product_name}}" style="height:50px;width:50px;object-fit:cover;"/>
                                    </a>
                                <a href="{{url('user/cuisine', ['id' => $cuisinename->product_id])}}">{{$cuisinename->product_name}}</a></div>

                                @endforeach

                            </div>
                        </li>


                        <li class="custom-link-right"><a href="#" target="_blank">Daily Menu</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main Menu End-->
</div>
