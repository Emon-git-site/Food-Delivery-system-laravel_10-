@extends('layouts.frontend')
@section('content')
    @include('layouts.partial_frontend.slider')

    <!-- ===============================SLIDER SECTION START============== -->
    <!-- ===============================CATEGORY SLIDER=================== -->
    <section>
        <div class="categroy-sec">
            <div class="category-inner">
                <div class="container-fluid">
                    <div class="baner-slider owl-carousel owl-theme">
                        @foreach ($subcategories as $subcategory)
                            <div class="item ">
                                <div class="cat-item-inner ">
                                    <a href="" class="cat-link ">
                                        <!-- Please your category image here -->
                                        <img src="http://127.0.0.1:8000/{{ $subcategory->image }}" alt="Image not Found"
                                            class="category-img img-fluid">
                                        <div class="cat-name">
                                            <p>{{ $subcategory->subcategory_name }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- banar slider end -->
                </div>
                <!-- container-fluid end -->
            </div>
            <!-- category inner end -->
        </div>
        <!-- catagory sec end -->
    </section>
    <!-- ===============================CATEGORY SLIDER END=============== -->
    <!-- =================================BANNER SECTION START============= -->
    <section>
        <div class="banner-content">
            <div class="container-fluid">
                <div class="banner-sec-bg custom-padding">
                    <div class="banner-inner">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-6 col-sm-6 my-2">
                                <div class="baner">
                                    <div class="baner-text">
                                        <h3>Organic Food</h3>
                                        <p>100% Pure Natural Food </p>
                                        <em class="shop-now"><a href="">Shop Now</a></em>
                                    </div>
                                    <div class="banar-image">
                                        <!-- Banar image are insert here -->
                                        <img src="{{ asset('frontend') }}/img/product/gallery_image1-min-1-768x768.jpg"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 my-2">
                                <div class="baner">
                                    <div class="baner-text">
                                        <h3>Fresh First Food</h3>
                                        <p>100% Pure Natural Food </p>
                                        <em class="shop-now"><a href="">Shop Now</a></em>
                                    </div>
                                    <div class="banar-image">
                                        <!-- Banar image are insert here -->
                                        <img src="{{ asset('frontend') }}/img/product/gallery_image5-min-768x768.jpg"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 my-2">
                                <div class="baner">
                                    <div class="baner-text">
                                        <h3>Organic Food</h3>
                                        <p>100% Pure Natural Food </p>
                                        <em class="shop-now"><a href="">Shop Now</a></em>
                                    </div>
                                    <div class="banar-image">
                                        <!-- Banar image are insert here -->
                                        <img src="{{ asset('frontend') }}/img/product/gallery_image2-min-1-768x768.jpg"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->
                    </div>
                    <!-- Banner Inner end -->
                </div>
                <!-- Banner Sec Bg end  -->
            </div>
            <!-- Container end -->
        </div>
        <!-- Banner Content -->
    </section>
    <!-- =================================BANNER SECTION END============= -->
    <!-- =================================TOP RECIPES SECTION START============= -->
    <section>
        <div class="top-recipes">
            <div class="top-recipes-bg">
                <div class="container-fluid custom-padding">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="sm-baner">
                                <a href="">
                                    <img src="{{ asset('frontend') }}/img/baner/slice-crispy-pizza-with-meat-cheese.jpg"
                                        alt="Baner Image not Found" class="sm-baner-image">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="paralex">
                                <img src="{{ asset('frontend') }}/img/icon/banner_image_2.png" alt=""
                                    class="icon-plx" id="top-recipes-top">
                                <img src="{{ asset('frontend') }}/img/icon/—Pngtree—fast food chicken drumstick fried_5746705.png"
                                    alt="" class="icon-plx-2" id="top-recipes-left">
                            </div>
                            <div class="top-recipes-inner">
                                <div class="recipes-head">
                                    <h2>Top Recipes</h2>
                                    <a href="">See All <span class="fas fa-long-arrow-alt-right"></span></a>
                                </div>
                                <div class="row">
                                    @foreach ($tops as $top)
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="product-list-inner">
                                                <div class="recipes-image">
                                                    <img src="http://127.0.0.1:8000/{{ $top->image }}" alt="">
                                                </div>
                                                <div class="recipes-details">
                                                    <a href="">
                                                        <h5>{{ $top->name }}</h5>
                                                    </a>
                                                    <div class="cat-name-top-recipes">
                                                        {{ $top->subcategory->subcategory_name }}</div>

                                                    <p class="price pt-2">
                                                        @if ($top->discount_price > 0)
                                                            <del>{{ $website_setting->currency }}{{ $top->price }}</del>
                                                            {{ $website_setting->currency }}{{ $top->discount_price }}
                                                        @else
                                                            {{ $website_setting->currency }}{{ $top->price }}
                                                        @endif
                                                    </p>
                                                    <div class="buy-sec">
                                                        <ul class="buy-inner">
                                                            <li>
                                                                <a href="" class="cart-btn"><span
                                                                        class="fas fa-heart"></span></a>
                                                            </li>
                                                            <li>
                                                                <a href="" class="cart-btn" data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal"><span
                                                                        class="fas fa-eye"></span></a>
                                                            </li>
                                                            <li>
                                                                <a href="" class="cart-btn"><span
                                                                        class="fas fa-shopping-cart"></span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- row end -->
                </div>
                <!-- container-fluid end-->
            </div>
            <!-- top recipes-bg end-->
        </div>
        <!-- top-recipes end  -->
    </section>
    <!-- =================================TOP RECIPES SECTION END============= -->
    <!-- =================================DISCOUNT SECTION START============= -->
    <section>
        <div class="discount-bg">
            <div class="container-fluid custom-padding">
                <div class="discount-inner">
                    <div class="row">
                        <div class="col-md-6 text-section">
                            <div class="timer-sec">
                                <h1 class="dis-head">Special Discount For All Food Products</h1>
                                <p class="dis-details">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus
                                    blandit massa enim Nullam nunc varius.</p>

                                <div class="timer">
                                    <ul id="example">
                                        <li>
                                            <h1 class="days">00</h1>
                                            <p class="days_text">Days</p>
                                        </li>
                                        <li class="seperator">:</li>
                                        <li>
                                            <h1 class="hours">00</h1>
                                            <p class="hours_text">Hours</p>
                                        </li>
                                        <li class="seperator">:</li>
                                        <li>
                                            <h1 class="minutes">00</h1>
                                            <p class="minutes_text">Minutes</p>
                                        </li>
                                        <li class="seperator">:</li>
                                        <li>
                                            <h1 class="seconds">00</h1>
                                            <p class="seconds_text">Seconds</p>
                                        </li>
                                    </ul>

                                    <a href="" class="btn-main">Order Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 discount-img-sec">
                            <img src="{{ asset('frontend') }}/img/product/barger.png" alt=""
                                class="discount-img">
                        </div>
                    </div>
                </div>
                <!-- discount inner end -->
            </div>
            <!-- container end  -->
        </div>
        <!-- discount bg end  -->
    </section>
    <!-- =================================DISCOUNT SECTION END============= -->
    <!-- =================================PRODUCT SECTION START============= -->
    <section>
        <div class="product-bg">
            <div class="paralex">
                <img src="{{ asset('frontend') }}/img/icon/shape33.png" alt="" class="icon-plx-4"
                    id="paralex-pd">
                <img src="{{ asset('frontend') }}/img/icon/shape29.png" alt="" class="icon-plx-5"
                    id="paralex-pd-there">
                <img src="{{ asset('frontend') }}/img/icon/shape26.png" alt="" class="icon-plx-6"
                    id="paralex-pd-for">
                <img src="{{ asset('frontend') }}/img/icon/shape32.png" alt="" class="icon-plx-3"
                    id="paralex-pd-tow">
            </div>
            <div class="container-fluid custom-padding">
                <div class="row">
                    <div class="section-head">
                        <h2>All Product</h2>
                    </div>
                </div>
                <!-- section  heading row end-->
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="portfolio__menu">
                            <li><button class="menu active" type="button" data-filter="all">all Product</button></li>
                            @foreach ($subcategories as $subcategory)
                                <li><button class="menu" type="button"
                                        data-filter=".product-{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</button>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <!-- product category row end -->

                <div class="product">
                    <div class="row product-menu">
                        @foreach ($catwise_product as $row)
                            <div class="col-md-3 col-sm-6 my-2 col-12 mix product-{{ $row->subcategory_id }}">
                                <div class="product-inner">
                                    <div class="pruct-img-sec">
                                        <div class="product-img">
                                            <img src="http://127.0.0.1:8000/{{ $row->image }}" alt="Image not found"
                                                class="pd-image">
                                        </div>
                                        <div class="product-details">
                                            <div class="rating">
                                                <ul>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="far fa-star"></span></li>
                                                </ul>
                                            </div>
                                            <a href="" class="product-name">
                                                <h5>{{ $row->name }}</h5>
                                            </a>

                                            <p class="price pt-2">
                                                @if ($row->discount_price > 0)
                                                    <del>{{ $website_setting->currency }}{{ $row->price }}</del>
                                                    {{ $website_setting->currency }}{{ $row->discount_price }}
                                                @else
                                                    {{ $website_setting->currency }}{{ $row->price }}
                                                @endif
                                            </p>

                                            <div class="buy-sec pd-inside">
                                                <ul class="buy-inner">
                                                    <li>
                                                        <a href="" class="cart-btn"><span
                                                                class="fas fa-heart"></span></a>
                                                    </li>
                                                    <li>
                                                        <a href="" class="cart-btn" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal"><span
                                                                class="fas fa-eye"></span></a>
                                                    </li>
                                                    <li>
                                                        <a href="" class="cart-btn"><span
                                                                class="fas fa-shopping-cart"></span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- product end  -->
            </div>
            <!-- container end -->
        </div>
        <!-- product-bg end -->
    </section>
    <!-- =================================PRODUCT SECTION END============= -->
    <!-- ============LIFE JEARNY========= -->
    <section>
        <div class="jearny-bg">
            <div class="bg-filter">
                <div class="container-fluid custom-padding">
                    <div class="jearny-center">
                        <div class="col-md-10">
                            <div class="row justify-content-center">
                                <div class="col-md-4 col-sm-6 mb-3">
                                    <div class="product-jearny-bg">
                                        <img src="{{ asset('frontend') }}/img/icon/pizza.svg" alt="">
                                        <div class="jearny-cotent">
                                            <div class="">
                                                <h2>530+</h2>
                                                <p class="juarny-des">pizza</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-3">
                                    <div class="product-jearny-bg">
                                        <img src="{{ asset('frontend') }}/img/icon/burger.svg" alt="">
                                        <div class="jearny-cotent">
                                            <div class="">
                                                <h2>180+</h2>
                                                <p class="juarny-des">burger</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-3">
                                    <div class="product-jearny-bg">
                                        <img src="{{ asset('frontend') }}/img/icon/drink.svg" alt="">
                                        <div class="jearny-cotent">
                                            <div class="">
                                                <h2>250+</h2>
                                                <p class="juarny-des">drink</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============LIFE JARNY END========= -->


    <!-- ==================CHEFC===== -->
    <section>
        <div class="chefc-sec my-5">
            <div class="container-fluid custom-padding">
                <div class="row">
                    <div class="section-head mb-5">
                        <h2>Our Team</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="chefc-slider owl-carousel owl-theme">
                        <div class="item">
                            <div class="chefc-card ">
                                <div class="chefc-img-div" data-bs-toggle="modal" data-bs-target="#chefc">
                                    <div class="img-view">
                                        <img src="{{ asset('frontend') }}/img/chefc/chefc-1.jpg" alt=""
                                            class="chefc-img">
                                    </div>
                                    <div class="view-info">
                                        <p>View Details</p>
                                    </div>
                                </div>
                                <div class="chefc-des">
                                    <h3 class="chefc-name">Andy Moore</h3>
                                    <p class="title">
                                        MASTER CHEF IN BROOKLIN
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="chefc-card ">
                                <div class="chefc-img-div" data-bs-toggle="modal" data-bs-target="#chefc">
                                    <div class="img-view">
                                        <img src="{{ asset('frontend') }}/img/chefc/2 (1).jpg" alt=""
                                            class="chefc-img">
                                    </div>
                                    <div class="view-info">
                                        <p>View Details</p>
                                    </div>
                                </div>
                                <div class="chefc-des">
                                    <h3 class="chefc-name">Royce N. Burton</h3>
                                    <p class="title">
                                        MASTER CHEF IN BROOKLIN
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="chefc-card ">
                                <div class="chefc-img-div" data-bs-toggle="modal" data-bs-target="#chefc">
                                    <div class="img-view">
                                        <img src="{{ asset('frontend') }}/img/chefc/1 (1).jpg" alt=""
                                            class="chefc-img">
                                    </div>
                                    <div class="view-info">
                                        <p>View Details</p>
                                    </div>
                                </div>
                                <div class="chefc-des">
                                    <h3 class="chefc-name">Jesse M. Wise</h3>
                                    <p class="title">
                                        MASTER CHEF IN BROOKLIN
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="chefc" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="modal-body">
                                    <div class="fs-wrapper">
                                        <div class="row">
                                            <div class="col-md-6 my-2">
                                                <div class="chegc-image">
                                                    <img src="{{ asset('frontend') }}/img/chefc/1.jpg"
                                                        alt="Image not found">
                                                </div>
                                            </div>
                                            <div class="col-md-6 my-2">
                                                <div class="chefc-details">
                                                    <h1 class="chefc-name">Jesse M. Wise</h1>
                                                    <p class="chefc-title">
                                                        MASTER CHEF IN BROOKLIN
                                                    </p>

                                                    <p class="long-description">
                                                        Duis aute irure dolor in reprehenderit in voluptate velit esse
                                                        cillum dolore eu fugiat. Xillum dolore eu fugiat nulla pariatur.
                                                        olore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                        consequat.
                                                    </p>

                                                    <h5 class="find">Find on Social:</h5>
                                                    <ul class="chefc-social">
                                                        <li><a href="" class="social-link"><span
                                                                    class="fab fa-facebook-f"></span></a></li>
                                                        <li><a href="" class="social-link"><span
                                                                    class="fab fa-twitter"></span></a></li>
                                                        <li><a href="" class="social-link"><span
                                                                    class="fab fa-instagram"></span></a></li>
                                                        <li><a href="" class="social-link"><span
                                                                    class="fab fa-pinterest"></span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="success-wrapper"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- ==================CHEFC END===== -->

    <!-- =================================CLIENT REVIEWS START============= -->
    <section>
        <div class="client-bg">
            <div class="container-fluid custom-padding">
                <div class="row">
                    <div class="section-head mb-5">
                        <h2>What your client says</h2>
                    </div>
                </div>
                <!-- row end -->
                <div class="client-body">
                    <div class="row">
                        <div class="client-reviews  owl-carousel owl-theme">
                            @foreach ($clientsays as $clientsay)
                                <div class="client-body item">
                                    <div class="column-item elementor-testimonial-item">
                                        <div class="item-box">
                                            <div class="top">
                                                <div class="details">
                                                    <div class="avatar">
                                                        <div class="elementor-testimonial-image">
                                                            <img src="{{ asset('frontend') }}/img/user/avatar-1.jpg"
                                                                class="attachment-full size-full lazyloaded"
                                                                alt="">
                                                            <i aria-hidden="true" class="fas fa-quote-left"></i>
                                                        </div>
                                                    </div>
                                                    <div class="info">
                                                        <div class="name">{{ $clientsay->name }}</div>
                                                        <div class="job">Design</div>
                                                    </div>
                                                </div>

                                                <div class="elementor-testimonial-rating">
                                                    @if ($clientsay->rating == 1)
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star "></i>
                                                        <i class="fas fa-star "></i>
                                                        <i class="fas fa-star "></i>
                                                        <i class="fas fa-star"></i>
                                                    @elseif ($clientsay->rating == 2)
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star "></i>
                                                        <i class="fas fa-star "></i>
                                                        <i class="fas fa-star"></i>
                                                    @elseif ($clientsay->rating == 3)
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star "></i>
                                                        <i class="fas fa-star"></i>
                                                    @elseif ($clientsay->rating == 4)
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star"></i>
                                                    @elseif ($clientsay->rating == 5)
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="content"> "{{ $clientsay->message }}"</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                <!-- cliend body end  -->
            </div>
            <!-- container end -->
        </div>
        <!-- client-bg end -->
    </section>
    <!-- =================================CLIENT REVIEWS END============= -->

    <!--quick view Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="sp-loading"><img src="{{ asset('frontend') }}/img/sp-loading.gif"
                                        alt=""><br>LOADING IMAGES</div>
                                <div class="sp-wrap">
                                    <a href="img/product/11.png"><img src="{{ asset('frontend') }}/img/product/11.png"
                                            alt=""></a>
                                    <a href="img/product/4-600x600.png"><img
                                            src="{{ asset('frontend') }}/img/product/4-600x600.png" alt=""></a>
                                    <a href="img/product/6-600x600.png"><img
                                            src="{{ asset('frontend') }}/img/product/6-600x600.png" alt=""></a>
                                    <a href="img/product/7-600x600.png"><img
                                            src="{{ asset('frontend') }}/img/product/7-600x600.png" alt=""></a>
                                    <a href="img/product/8-600x600.png"><img
                                            src="{{ asset('frontend') }}/img/product/8-600x600.png" alt=""></a>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="product-details">
                                    <h2 class="product-name-single">
                                        Organic Pizza whth vasitable.........
                                    </h2>
                                    <div class="pr-rt">
                                        <p class="price-single">$32</p>
                                        <div class="rating">
                                            <ul>
                                                <li><span class="fas fa-star"></span></li>
                                                <li><span class="fas fa-star"></span></li>
                                                <li><span class="fas fa-star"></span></li>
                                                <li><span class="fas fa-star"></span></li>
                                                <li><span class="far fa-star"></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <p class="product-descriotion">
                                    Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a
                                    piece of classical Latin literature from 45 BC, making it over 2000 years old. Contrary
                                    to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece
                                    of classical Latin literature from 45 BC, making it over 2000 years old.
                                </p>
                                <hr>
                                <div class="cart_extra">
                                    <div class="cart-product-quantity">
                                        <div class="quantity">
                                            <button class="qty-count qty-count--minus minus" data-action="minus"
                                                type="button">-</button>
                                            <input class="product-qty qty" type="text" name="quantity" min="0"
                                                max="10" value="1" title="Qty" size="4">
                                            <button class="qty-count qty-count--add plus" data-action="add"
                                                type="button">+</button>

                                        </div>

                                    </div>
                                    <div class="cart_btn">
                                        <button class="btn-main" type="button">Add to cart</button>
                                        <a class="add_wishlist" href="#"><i class="far fa-heart"></i></a>
                                    </div>
                                </div>
                                <ul class="product-meta list_none">
                                    <li>Category: <a href="#">Fresh Fruits</a>, <a href="#">Jiuce</a></li>
                                    <li>Tags: <a href="#" rel="tag">Fruits</a>, <a href="#"
                                            rel="tag">Natural</a>, <a href="#" rel="tag">Organic</a>
                                    </li>
                                </ul>
                                <div class="lh-social-share d-flex">
                                    <p class="share">Share:</p>
                                    <ul class="social-ul d-flex">
                                        <li><a href="" class="social-link"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li><a href="" class="social-link"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="" class="social-link"><i class="fab fa-instagram"></i></a>
                                        </li>
                                        <li><a href="" class="social-link"><i class="fab fa-linkedin"></i></a>
                                        </li>
                                        <li><a href="" class="social-link"><i class="fab fa-pinterest"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="brand-wrap">
                                    <h5 class="title-brand">Guaranteed Safe Checkout</h5>
                                    <img src="{{ asset('frontend') }}/https://demo2wpopal.b-cdn.net/poco/wp-content/uploads/2020/08/trust-symbols.png"
                                        data-src="{{ asset('frontend') }}/" class="image-responsive lazyloaded">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
