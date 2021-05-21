<header class="main-menu-area">
    <div class="container">
        <div class="row">
            <!-- SHOPPING-CART START -->
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pull-right shopingcartarea">
                <div class="shopping-cart-out pull-right">
                    <div class="shopping-cart">
                        <a class="shop-link" href="{{ route('view_cart') }}" title="View my shopping cart">
                            <i class="fa fa-shopping-cart cart-icon"></i>
                            <b>My Cart</b>
                            <span class="ajax-cart-quantity">{{ Cart::content()->count() }}</span>
                        </a>
                        <div class="shipping-cart-overly">
                            @foreach (Cart::content() as $row)
                                <div class="shipping-item">
                                    <span class="cross-icon"><a href="{{ route('remove_item_cart',['id'=>$row->rowId]) }}"><i class="fa fa-times-circle"></i></a></span>
                                    <div class="shipping-item-image">
                                        <a href="#"><img src="{{ asset($row->options->has('thumbnail') ? $row->options->thumbnail : '') }}" width="80" height="80" alt="shopping image" /></a>
                                    </div>
                                    <div class="shipping-item-text">
                                        <span>{{ $row->qty }} <span class="pro-quan-x">x</span> <a href="#" class="pro-cat">{{ $row->name }}</a></span>
                                        <span class="pro-quality"><a href="#">Size: {{ $row->options->has('size') ? $row->options->size : '' }}</a></span>
                                        <p>{{ $row->price }}</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="shipping-total-bill">
                                {{-- <div class="cart-prices">
                                    <span class="shipping-cost">$2.00</span>
                                    <span>Shipping</span>
                                </div> --}}
                                <div class="total-shipping-prices">
                                    <span class="shipping-total">{{ Cart::pricetotal(0).' '. "VNĐ" }}</span>
                                    <span>Total</span>
                                </div>										
                            </div>
                            <div class="shipping-checkout-btn">
                                <a href="checkout.html">Check out <i class="fa fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
            <!-- SHOPPING-CART END -->
            <!-- MAINMENU START -->
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 no-padding-right menuarea">
                <div class="mainmenu">
                    <nav>
                        <ul class="list-inline mega-menu">
                            <li class="active"><a href="{{ route('index') }}">Trang chủ</a></li>
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{route('product_by_category',['id'=>$category->name])}}">{{ $category->name}}</a>
                                    <!-- DRODOWN-MEGA-MENU START -->	
                                    <div class="drodown-mega-menu">
                                        @foreach ($category->childs as $child )
                                            <div class="left-mega col-xs-3">
                                                <div class="mega-menu-list">
                                                    <a class="mega-menu-title" href="{{route('product_by_category',['id'=>$child->name])}}">{{ $child->name }}</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>	
                                    <!-- DRODOWN-MEGA-MENU END -->										
                                </li>
                            @endforeach
                            <li><a href="#">Delivery</a></li>
                            <li><a href="about-us.html">About us</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- MAINMENU END -->
        </div>
        <div class="row">
            <!-- MOBILE MENU START -->
            <div class="col-sm-12 mobile-menu-area">
                <div class="mobile-menu hidden-md hidden-lg" id="mob-menu">
                    <span class="mobile-menu-title">MENU</span>
                    <nav>
                        <ul>
                            <li><a href="index.html">Home</a>
                                <ul>
                                    <li><a href="index.html">Home variation 1</a></li>
                                    <li><a href="index-2.html">Home variation 2</a></li>
                                </ul>														
                            </li>								
                            <li><a href="shop-gird.html">Women</a>
                                <ul>
                                    <li><a href="shop-gird.html">Tops</a>
                                        <ul>
                                            <li><a href="shop-gird.html">T-Shirts</a></li>
                                            <li><a href="shop-gird.html">Blouses</a></li>
                                        </ul>													
                                    </li>
                                    <li><a href="shop-gird.html">Dresses</a>
                                        <ul>
                                            <li><a href="shop-gird.html">Casual Dresses</a></li>
                                            <li><a href="shop-gird.html">Summer Dresses</a></li>
                                            <li><a href="shop-gird.html">Evening Dresses</a></li>	
                                        </ul>	
                                    </li>

                                </ul>
                            </li>
                            <li><a href="shop-gird.html">men</a>
                                <ul>											
                                    <li><a href="shop-gird.html">Tops</a>
                                        <ul>
                                            <li><a href="shop-gird.html">Sports</a></li>
                                            <li><a href="shop-gird.html">Day</a></li>
                                            <li><a href="shop-gird.html">Evening</a></li>
                                        </ul>														
                                    </li>
                                    <li><a href="shop-gird.html">Blouses</a>
                                        <ul>
                                            <li><a href="shop-gird.html">Handbag</a></li>
                                            <li><a href="shop-gird.html">Headphone</a></li>
                                            <li><a href="shop-gird.html">Houseware</a></li>
                                        </ul>														
                                    </li>
                                    <li><a href="shop-gird.html">Accessories</a>
                                        <ul>
                                            <li><a href="shop-gird.html">Houseware</a></li>
                                            <li><a href="shop-gird.html">Home</a></li>
                                            <li><a href="shop-gird.html">Health & Beauty</a></li>
                                        </ul>														
                                    </li>
                                </ul>										
                            </li>
                            <li><a href="shop-gird.html">clothing</a></li>
                            <li><a href="shop-gird.html">tops</a></li>
                            <li><a href="shop-gird.html">T-shirts</a></li>
                            <li><a href="#">Delivery</a></li>
                            <li><a href="about-us.html">About us</a></li>
                        </ul>
                    </nav>
                </div>						
            </div>
            <!-- MOBILE MENU END -->
        </div>				
    </div>
</header>