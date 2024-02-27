<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="author" content="freelancerhelaluddin100">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Food - Ordaring HTML Web Template">
    <meta name="keywords" content="html template, food, food ordaring, echomarch, food revewring,">
    <title>Food - Ordaring HTML Web Template</title>
    <!-- ====================Favicon============ -->
    <link rel="icon" sizes="32x32" href="img/favicon.png">
    <!-- ==================LINK ALL STYLE ARE HERE=============== -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/font/fontawesome/css/all.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/smoothproducts.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/timePic.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/responsive.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/toastr/toastr.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

    <div class='spinner__wrapper' id="spinner__wrapper">
        <img src="img/Pizza spinning.gif" alt="" class="spiner">
    </div>
    <!-- ==========================Preloder============= -->

    <div class="weapper">
        <!-- ======================================NAVIGATION SECTION================== -->
        <header>
            <nav>
                <div class="header-part header-reduce sticky">
                    <!-- ===============TOP HEADER START============ -->
                    <div class="header-top">
                        <div class="head-container">
                            <div class="header-top-inner">
                                <div class="header-top-left">
                                    <a href="#" class="top-cell"><img
                                            src="{{ asset('frontend') }}/img/icon/fon.png" alt="Image not Found">
                                        <span>{{ $website_setting->phone_one }}</span></a>
                                    <a href="#" class="top-email"><span>{{ $website_setting->support_email }}</span></a>
                                </div>
                                <!-- header-top left end -->
                                <div class="header-top-right">
                                    <div class="social-top">
                                        <ul>
                                            <li><a href="{{ $website_setting->twitter }}"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="{{ $website_setting->twitter }}"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                            </li>
                                            <li><a href="{{ $website_setting->instagram }}"><i class="fab fa-instagram"
                                                        aria-hidden="true"></i></a></li>
                                            <li><a href="{{ $website_setting->linkedin }}"><i class="fab fa-linkedin"
                                                        aria-hidden="true"></i></a></li>
                                            <li><a href="{{ $website_setting->youtube }}"><i class="fab fa-youtube" aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="language-menu">
                                        @guest
                                            <a href="{{ route('user.login') }}" class="current-lang" id="lanId"><i
                                                    class="fa fa-user"></i>Login</i></a>
                                        @else
                                            <a href="#" class="current-lang" id="lanId"> {{ Auth::user()->name }}
                                                <i class="fa fa-user" aria-hidden="true"></i></a>
                                            <ul class="language">
                                                <li><a href="{{ route('home') }}"><i class="fa fa-angle-right"
                                                            aria-hidden="true"></i>Dashboard</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"
                                                            aria-hidden="true"></i>Setting</a></li>
                                                <li><a href="#"
                                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                                </li>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </ul>
                                        @endguest
                                    </div>
                                </div>
                                <!-- header-top-right end -->
                            </div>
                            <!-- head-top-inned end -->
                        </div>
                        <!-- head-container end -->
                    </div>
                    <!-- ===============TOP HEADER END============ -->

                    <!-- =================MAIN NAVIGATION START============ -->
                    <div class="header-bottom">
                        <div class="container-fluid custom-padding">
                            <div class="main-nav">
                                <!-- left menu -->
                                <div class="left-menu">
                                    <!-- logo start -->
                                    <div class="logo">
                                        <a href="{{ url('/') }}">
                                            <img src="{{ asset('frontend') }}/img/logo.png" alt="Image not Found">
                                        </a>
                                    </div>
                                    <!-- logo end -->
                                    <div class="menu-main">
                                        <ul>
                                            <li class="has-child"><a href="{{ url('/') }}">Home</a></li>
                                            <li class="mega-menu"><a href="#">Menu</a></li>
                                            <li class="has-child"><a href="">Shop</a></li>
                                            <li class="has-child"><a href="#">Pages</a>
                                                <ul class="drop-nav">
                                                    <li><a href="index.html"><i class="fa fa-angle-right"></i> Home
                                                            Page</a></li>
                                                    <li><a href="single_product.html"><i
                                                                class="fa fa-angle-right"></i> Single Product</a></li>
                                                    <li><a href="cat-by-product.html"><i
                                                                class="fa fa-angle-right"></i> Cat By Product</a></li>
                                                    <li><a href="blog.html"><i class="fa fa-angle-right"></i> Blog</a>
                                                    </li>
                                                    <li><a href="blog-single.html"><i class="fa fa-angle-right"></i>
                                                            Blog Single Post</a></li>
                                                    <li><a href="checkout.html"><i class="fa fa-angle-right"></i>
                                                            Checkout</a></li>
                                                    <li><a href="cart.html"><i class="fa fa-angle-right"></i> Cart</a>
                                                    </li>
                                                    <li><a href="wishlist.html"><i class="fa fa-angle-right"></i>
                                                            Wishlist</a></li>
                                                    <li><a href="profile.html"><i class="fa fa-angle-right"></i>
                                                            Profile</a></li>
                                                    <li><a href="contact.html"><i class="fa fa-angle-right"></i>
                                                            Contact</a></li>
                                                    <li><a href="login.html"><i class="fa fa-angle-right"></i> Login $
                                                            Ragistar</a></li>
                                                </ul>
                                            </li>
                                            <li class="has-child"><a href="blog.html">Blog</a></li>
                                            <li class="has-child"><a href="contact.html">Contact</a></li>
                                        </ul>
                                    </div>
                                    <!-- main-menu end -->
                                </div>
                                <!-- left menu end  -->
                                <!-- search bar -->
                                <div class="search-part">
                                    <div class="search-box">
                                        <form action="">
                                            <input type="text" name="txt" placeholder="Search">
                                            <input type="submit" name="submit" value=" ">
                                        </form>
                                    </div>
                                </div>
                                <!-- ----------search input end------- -->
                                <!-- header right section start -->
                                <div class="header-info">
                                    <div class="header-info-inner">
                                        <div class="book-table header-collect book-md">
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#bookatable"><img
                                                    src="{{ asset('frontend') }}/img/icon/chair.svg"
                                                    alt="Image not Found"><span class="count-text">Book a
                                                    Table</span></a>
                                        </div>

                                        <div class="shop-cart header-collect">
                                            <a href="#"><img
                                                    src="{{ asset('frontend') }}/img/icon/icon-basket.png"
                                                    alt="Image not Found"> 2 <span class="count-text"> items - $
                                                    20.89</span></a>
                                            <div class="cart-wrap">
                                                <div class="cart-blog">
                                                    <div class="cart-item">
                                                        <div class="cart-item-left">
                                                            <img src="{{ asset('frontend') }}/img/product/7-600x600.png"
                                                                alt="Image not Found" class="img-fluid">
                                                        </div>
                                                        <div class="cart-item-right">
                                                            <h6>Caramel Chesse Cake</h6>
                                                            <span>$ 14.00</span>
                                                        </div>
                                                        <a href=""><span class="delete-icon"></span></a>
                                                    </div>
                                                    <div class="cart-item">
                                                        <div class="cart-item-left">
                                                            <img src="{{ asset('frontend') }}/img/product/pizza_2.png"
                                                                alt="Image not Found" class="img-fluid">
                                                        </div>
                                                        <div class="cart-item-right">
                                                            <h6>Caramel Chesse Cake</h6>
                                                            <span>$ 14.00</span>
                                                        </div>
                                                        <a href=""><span class="delete-icon"></span></a>
                                                    </div>
                                                    <div class="subtotal">
                                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                            <h6>Subtotal :</h6>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                            <span>$ 140.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="cart-btn">
                                                        <a href="#" class="btn-black view">VIEW ALL</a>
                                                        <a href="#" class="btn-main checkout">CHECK OUT</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- header-info end -->
                                <div class="menu-icon">
                                    <a href="#" class="hambarger">
                                        <span class="bar-1"></span>
                                        <span class="bar-2"></span>
                                        <span class="bar-3"></span>
                                    </a>
                                </div>
                                <!-- mobile menu icon end -->
                            </div>
                            <!-- main nav end -->
                        </div>
                        <!-- container end -->
                    </div>
                    <!-- =================MAIN NAVIGATION END============ -->
                    <!-- ============MOBILE NAVIGATION ========= -->
                    <div class="footer__nav">
                        <ul class="menus">
                            <div class="slider-menu"></div>
                            <li class="">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#M-cart">
                                    <div class="menu-dev">
                                        <img src="{{ asset('frontend') }}/img/icon/shopping-cart.svg"
                                            class="mobile-nav-icon" alt="">
                                    </div> <span>Cart</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#M-category">
                                    <div class="menu-dev">
                                        <img src="{{ asset('frontend') }}/img/icon/menu.svg" class="mobile-nav-icon"
                                            alt="">
                                    </div> <span>Category</span>
                                </a>
                            </li>
                            <li class="active-icon">
                                <a href="#">
                                    <div class="menu-dev">
                                        <img src="{{ asset('frontend') }}/img/icon/home.svg" class="mobile-nav-icon"
                                            alt="">
                                    </div> <span>Home</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#bookatable">
                                    <div class="menu-dev">
                                        <img src="{{ asset('frontend') }}/img/icon/chair.svg" class="mobile-nav-icon"
                                            alt="">
                                    </div> <span>Wishlist</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="profile.html">
                                    <div class="menu-dev">
                                        <img src="{{ asset('frontend') }}/img/icon/user.svg" class="mobile-nav-icon"
                                            alt="">
                                    </div>
                                    <span>Profile</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- ============MOBILE NAVIGATION END========= -->
                </div>
                <!-- header-part end -->
            </nav>
        </header>

        <!-- =============mobile nav model==== -->
        <!-- ======cart model====== -->
        <div class="modal fade" id="M-cart" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="fas fa-times"></i></button>
                    </div>

                    <div class="modal-body">
                        <div class="cart-blog mobile-cart-model">
                            <div class="cart-item">
                                <div class="cart-item-left">
                                    <img src="{{ asset('frontend') }}/img/product/7-600x600.png"
                                        alt="Image not Found" class="img-fluid">
                                </div>
                                <div class="cart-item-right">
                                    <h6>Caramel Chesse Cake</h6>
                                    <span>$ 14.00</span>
                                </div>
                                <a href=""><span class="delete-icon"></span></a>
                            </div>
                            <div class="cart-item">
                                <div class="cart-item-left">
                                    <img src="{{ asset('frontend') }}/img/product/7-600x600.png"
                                        alt="Image not Found" class="img-fluid">
                                </div>
                                <div class="cart-item-right">
                                    <h6>Caramel Chesse Cake</h6>
                                    <span>$ 14.00</span>
                                </div>
                                <a href=""><span class="delete-icon"></span></a>
                            </div>
                            <div class="cart-item">
                                <div class="cart-item-left">
                                    <img src="{{ asset('frontend') }}/img/product/7-600x600.png"
                                        alt="Image not Found" class="img-fluid">
                                </div>
                                <div class="cart-item-right">
                                    <h6>Caramel Chesse Cake</h6>
                                    <span>$ 14.00</span>
                                </div>
                                <a href=""><span class="delete-icon"></span></a>
                            </div>
                            <div class="cart-item">
                                <div class="cart-item-left">
                                    <img src="{{ asset('frontend') }}/img/product/pizza_2.png" alt="Image not Found"
                                        class="img-fluid">
                                </div>
                                <div class="cart-item-right">
                                    <h6>Caramel Chesse Cake</h6>
                                    <span>$ 14.00</span>
                                </div>
                                <a href=""><span class="delete-icon"></span></a>
                            </div>
                            <div class="subtotal">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h6>Subtotal :</h6>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <span>$ 140.00</span>
                                </div>
                            </div>
                            <div class="cart-btn">
                                <a href="#" class="btn-black view">VIEW ALL</a>
                                <a href="#" class="btn-main checkout">CHECK OUT</a>
                            </div>
                        </div>
                    </div>

                    <div class="success-wrapper"></div>
                </div>
            </div>
        </div>
        <!-- =======category model==== -->
        <div class="modal fade" id="M-category" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="cart-blog mobile-cart-model">
                            <div class="category-modal">
                                <ul class="category-list-m">
                                    <li class="category-list-m">
                                        <a href="" class="category-link">
                                            <div class="cat-img"><img
                                                    src="{{ asset('frontend') }}/img/category/category-11.png"
                                                    alt=""></div>
                                            <span class="cat-name-m">BBQ Category</span>
                                        </a>
                                    </li>
                                    <li class="category-list-m">
                                        <a href="" class="category-link">
                                            <div class="cat-img"><img
                                                    src="{{ asset('frontend') }}/img/category/category3.png"
                                                    alt=""></div>
                                            <span class="cat-name-m">BBQ Category</span>
                                        </a>
                                    </li>
                                    <li class="category-list-m">
                                        <a href="" class="category-link">
                                            <div class="cat-img"><img
                                                    src="{{ asset('frontend') }}/img/category/category-22.png"
                                                    alt=""></div>
                                            <span class="cat-name-m">BBQ Category</span>
                                        </a>
                                    </li>
                                    <li class="category-list-m">
                                        <a href="" class="category-link">
                                            <div class="cat-img"><img
                                                    src="{{ asset('frontend') }}/img/category/category-33.png"
                                                    alt=""></div>
                                            <span class="cat-name-m">BBQ Category</span>
                                        </a>
                                    </li>
                                    <li class="category-list-m">
                                        <a href="" class="category-link">
                                            <div class="cat-img"><img
                                                    src="{{ asset('frontend') }}/img/category/category-44.png"
                                                    alt=""></div>
                                            <span class="cat-name-m">BBQ Category</span>
                                        </a>
                                    </li>
                                    <li class="category-list-m">
                                        <a href="" class="category-link">
                                            <div class="cat-img"><img
                                                    src="{{ asset('frontend') }}/img/category/category-55.png"
                                                    alt=""></div>
                                            <span class="cat-name-m">BBQ Category</span>
                                        </a>
                                    </li>
                                    <li class="category-list-m">
                                        <a href="" class="category-link">
                                            <div class="cat-img"><img
                                                    src="{{ asset('frontend') }}/img/category/category3.png"
                                                    alt=""></div>
                                            <span class="cat-name-m">BBQ Category</span>
                                        </a>
                                    </li>
                                    <li class="category-list-m">
                                        <a href="" class="category-link">
                                            <div class="cat-img"><img
                                                    src="{{ asset('frontend') }}/img/category/category5.png"
                                                    alt=""></div>
                                            <span class="cat-name-m">BBQ Category</span>
                                        </a>
                                    </li>
                                    <li class="category-list-m">
                                        <a href="" class="category-link">
                                            <div class="cat-img"><img
                                                    src="{{ asset('frontend') }}/img/category/category7.png"
                                                    alt=""></div>
                                            <span class="cat-name-m">BBQ Category</span>
                                        </a>
                                    </li>
                                    <li class="category-list-m">
                                        <a href="" class="category-link">
                                            <div class="cat-img"><img
                                                    src="{{ asset('frontend') }}/img/category/category-11.png"
                                                    alt=""></div>
                                            <span class="cat-name-m">BBQ Category</span>
                                        </a>
                                    </li>
                                    <li class="category-list-m">
                                        <a href="" class="category-link">
                                            <div class="cat-img"><img
                                                    src="{{ asset('frontend') }}/img/category/category-22.png"
                                                    alt=""></div>
                                            <span class="cat-name-m">BBQ Category</span>
                                        </a>
                                    </li>
                                    <li class="category-list-m">
                                        <a href="" class="category-link">
                                            <div class="cat-img"><img
                                                    src="{{ asset('frontend') }}/img/category/category-33.png"
                                                    alt=""></div>
                                            <span class="cat-name-m">BBQ Category</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="cart-btn">
                                <a href="#" class="btn-black view">VIEW ALL category</a>
                            </div>
                        </div>
                    </div>
                    <div class="success-wrapper"></div>
                </div>
            </div>
        </div>
        <!-- =============mobile nav model end==== -->
        <!-- ======================================NAVIGATION SECTION END================== -->
        <!--Reservation Modal -->
        <div class="modal fade" id="bookatable" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="fs-wrapper">

                            <form class="fs-form" method="post" action="{{ route('user.reservation.store') }}"
                                id="add_reservation_form">
                                @csrf
                                {{-- <input type="hidden" name="action" value="flex-reservations-submit"> --}}
                                {{-- <input type="hidden" name="nonce" value="79835a9b53"> --}}
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-left">
                                        <h2 class="center title ui-field-title">Reservation</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-left">
                                        <div class=" date">
                                            <label for="date">Date:</label>
                                            <input type="date" class="input-field field-date" name="r_date"
                                                required="required">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-left">
                                        <label for="timepiker">Time:</label>
                                        <input type="time" class="input-field " name="r_time"
                                            placeholder="Time" required="required">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class=" number">
                                            <label for="pepole">Number Of Pepole:</label>
                                            <input type="number" class="input-field" name="people"
                                                required="required">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="text">
                                            <label for="phone">Phone Number:</label>
                                            <input type="text" class="input-field field-text" name="phone"
                                                required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-left">
                                        <div class="text">
                                            <label for="name">Full Name:</label>
                                            <input type="text" class="input-field field-text" name="name"
                                                required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-left">
                                        <div class=" textarea">
                                            <label for="details">Details:</label>
                                            <textarea class="input-field field-textarea" name="details"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="submin-btn">
                                    <input type="submit" name="fs_submit" class="btn-main" value="BOOK A TABLE">
                                    <span class="laoding d-none">...</span>

                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="success-wrapper"></div>
                </div>
            </div>
        </div>

    </div>
    <!-- ==========================Book A Table  form====================== -->

    <!-- =======================================BOOK A TABLE END================ -->
    <!-- =======================================BODY SECTION START================ -->
    <div class="body-wraper">
        <div class="body-inner">
            <!-- ===============================SLIDER SECTION START============== -->

            @yield('content')

            <!-- =================================DELEVERY SECTION START============= -->
            <div class="middle_footer">
                <div class="container-fluid custom-padding">
                    <div class="row">
                        <div class="col-12">
                            <div class="shopping_info">
                                <div class="row justify-content-center">
                                    <div class="col-md-4 col-sm-6 position-relative">
                                        <div class="icon_box icon_box_style2">
                                            <div class="box_icon">
                                                <i class="fas fa-truck"></i>
                                            </div>
                                            <div class="intro_desc">
                                                <h5>Free Delivery</h5>
                                                <p>Phasellus blandit massa enim elit of passage varius nunc.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 position-relative">
                                        <div class="icon_box icon_box_style2">
                                            <div class="box_icon">
                                                <i class="fas fa-dollar-sign"></i>
                                            </div>
                                            <div class="intro_desc">
                                                <h5>30 Day Returns Guarantee</h5>
                                                <p>Phasellus blandit massa enim elit of passage varius nunc.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="icon_box icon_box_style2">
                                            <div class="box_icon">
                                                <i class="far fa-life-ring"></i>
                                            </div>
                                            <div class="intro_desc">
                                                <h5>27/4 Online Support</h5>
                                                <p>Phasellus blandit massa enim elit of passage varius nunc.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- col-12 end -->
                    </div>
                    <!-- row end -->
                </div>
                <!-- container end -->
            </div>
            <!-- middle footer end -->
            <!-- =================================DELEVERY SECTION END============= -->
            <!-- =================================FOOTER SECTION START============= -->
            <section>
                <footer>
                    <div class="footer-bg">
                        <div class="container-fluid custom-padding">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="footer_logo">
                                        <a href="index.html">
                                            <img alt="logo" src="{{ asset('frontend') }}/img/logo.png"
                                                style="height:30px; width: 130px;"></a>
                                    </div>
                                    <div class="footer_desc">
                                        <p>Phasellus blandit massa enim. elit id varius nunc. Lorems ipsum dolor sit
                                            consectetur industry. If you are going to use a passage of Lorem Ipsum.</p>
                                    </div>
                                    <ul class="contact_info list_none">
                                        <li>
                                            <span class="fas fa-mobile-alt"></span>
                                            <p>{{ $website_setting->phone_two }}</p>
                                        </li>
                                        <li>
                                            <span class="fas fa-envelope"></span>
                                            <a href="mailto:freelancerhelaluddin@gmail.com"
                                                class="email">{{ $website_setting->main_email }}</a>
                                        </li>
                                        <li>
                                            <span class="fas fa-map-marker-alt"></span>
                                            <p>{{ $website_setting->address }}</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4">
                                    <h5 class="widget_title">Information</h5>
                                    <ul class="list_none widget_links">
                                        <li><a href="#">Delivery Information</a></li>
                                        <li><a href="#">Secure Payment</a></li>
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Top Sellers</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                        <li><a href="#">Our Sitemap</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4">
                                    <h5 class="widget_title">Customer Support</h5>
                                    <ul class="list_none widget_links">
                                        <li><a href="#">My Account</a></li>
                                        <li><a href="#">Shopping Cart</a></li>
                                        <li><a href="#">Addresses</a></li>
                                        <li><a href="#">Discount</a></li>
                                        <li><a href="#">Orders History</a></li>
                                        <li><a href="#">Order Tracking</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4">
                                    <h5 class="widget_title">Instagram</h5>
                                    <ul class="list_none instafeed">
                                        <li>
                                            <a href="#"><img src="{{ asset('frontend') }}/img/blog/insta.jpg"
                                                    alt="insta_img"><span class="insta_icon"><i
                                                        class="fab fa-instagram"></i></span></a>
                                        </li>
                                        <li>
                                            <a href="#"><img
                                                    src="{{ asset('frontend') }}/img/blog/insta_img2.jpg"
                                                    alt="insta_img"><span class="insta_icon"><i
                                                        class="fab fa-instagram"></i></span></a>
                                        </li>
                                        <li>
                                            <a href="#"><img
                                                    src="{{ asset('frontend') }}/img/blog/insta_img3.jpg"
                                                    alt="insta_img"><span class="insta_icon"><i
                                                        class="fab fa-instagram"></i></span></a>
                                        </li>
                                        <li>
                                            <a href="#"><img
                                                    src="{{ asset('frontend') }}/img/blog/insta_img4.jpg"
                                                    alt="insta_img"><span class="insta_icon"><i
                                                        class="fab fa-instagram"></i></span></a>
                                        </li>
                                        <li>
                                            <a href="#"><img
                                                    src="{{ asset('frontend') }}/img/blog/insta_img5.jpg"
                                                    alt="insta_img"><span class="insta_icon"><i
                                                        class="fab fa-instagram"></i></span></a>
                                        </li>
                                        <li>
                                            <a href="#"><img
                                                    src="{{ asset('frontend') }}/img/blog/insta_img6.jpg"
                                                    alt="insta_img"><span class="insta_icon"><i
                                                        class="fab fa-instagram"></i></span></a>
                                        </li>
                                        <li>
                                            <a href="#"><img
                                                    src="{{ asset('frontend') }}/img/blog/insta_img7.jpg"
                                                    alt="insta_img"><span class="insta_icon"><i
                                                        class="fab fa-instagram"></i></span></a>
                                        </li>
                                        <li>
                                            <a href="#"><img
                                                    src="{{ asset('frontend') }}/img/blog/insta_img8.jpg"
                                                    alt="insta_img"><span class="insta_icon"><i
                                                        class="fab fa-instagram"></i></span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end container -->


                        <div class="bottom_footer">
                            <div class="container-fluid custom-padding">
                                <div class="row align-items-center">
                                    <div class="col-lg-4">
                                        <p class="copyright m-lg-0 text-center">Copyright © 2021 All Rights Reserved
                                        </p>
                                    </div>
                                    <div class="col-lg-4 order-lg-first">
                                        <ul class="list_none footer_payment text-center text-lg-left">
                                            <li>
                                                <a href="#"><img
                                                        src="{{ asset('frontend') }}/img/icon/visa.png"
                                                        alt="visa"></a>
                                            </li>
                                            <li>
                                                <a href="#"><img
                                                        src="{{ asset('frontend') }}/img/icon//discover.png"
                                                        alt="discover"></a>
                                            </li>
                                            <li>
                                                <a href="#"><img
                                                        src="{{ asset('frontend') }}/img/icon//master_card.png"
                                                        alt="master_card"></a>
                                            </li>
                                            <li>
                                                <a href="#"><img
                                                        src="{{ asset('frontend') }}/img/icon//paypal.png"
                                                        alt="paypal"></a>
                                            </li>
                                            <li>
                                                <a href="#"><img
                                                        src="{{ asset('frontend') }}/img/icon//amarican_express.png"
                                                        alt="amarican_express"></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4">
                                        <ul>
                                            <li><a href="{{ $website_setting->twitter }}"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="{{ $website_setting->twitter }}"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                            </li>
                                            <li><a href="{{ $website_setting->instagram }}"><i class="fab fa-instagram"
                                                        aria-hidden="true"></i></a></li>
                                            <li><a href="{{ $website_setting->linkedin }}"><i class="fab fa-linkedin"
                                                        aria-hidden="true"></i></a></li>
                                            <li><a href="{{ $website_setting->youtube }}"><i class="fab fa-youtube" aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- bottom footer end -->
                    </div>
                    <!-- footer-bg end -->
                </footer>
                <!-- footer end -->
            </section>
            <!-- =================================FOOTER SECTION END============= -->


        </div>
        <!-- body inner end  -->
    </div>
    <!-- =======================================BODY SECTION END================ -->

    <!-- ==================ALL SCRIPT ARE HERE======================= -->
    <!-- jQuery -->
    {{-- <script src="{{ asset('backend') }}/plugins/jquery/jquery.min.js"></script> --}}
    <script src="{{ asset('frontend') }}/js/jquery-2.1.3.min.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend') }}/js/timePic.js"></script>
    <script src="{{ asset('frontend') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend') }}/js/mixitup.min.js"></script>
    <script src="{{ asset('frontend') }}/js/mixtup.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.countdown.min.js"></script>
    <script src="{{ asset('frontend') }}/js/smoothproducts.min.js"></script>

    <!-- ======================CUSTOME SCRIPT ARE HERE================== -->
    <script src="{{ asset('frontend') }}/js/main.js"></script>
    <!-- Include SweetAlert from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- Toastr -->
    <script src="{{ asset('backend') }}/plugins/toastr/toastr.min.js"></script>
    {{-- dropify --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    @yield('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(function() {
                $('.text_area').summernote()
            });
            // dropify image
            $('.dropify').dropify();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // toaster message script
            $(document).ready(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
            });

            // add reservation form Submit
            $(document).on('submit', '#add_reservation_form', function(e) {
                e.preventDefault();
                $('.loading').removeClass('d-none');
                let url = $(this).attr('action');
                let request = $(this).serialize();
                $.ajax({
                    url: url,
                    type: 'post',
                    data: request,
                    success: function(response) {
                        $('#add_reservation_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#bookatable').modal('hide');
                        let errors = response.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach((message) => {
                                    toastr.error(message);
                                });
                            }
                        }
                        if (response.already_available) {
                            toastr.error(response.already_available);
                        }
                        else if(response.need_login) {
                            toastr.error(response.need_login);
                        } else {
                            toastr.success(response.add_reservation);
                        }

                    }
                })
            });
        });
    </script>
</body>

</html>
