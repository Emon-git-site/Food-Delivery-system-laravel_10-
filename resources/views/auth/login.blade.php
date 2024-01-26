{{-- 
@extends('layouts.app')
@section('content')
<div class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control"  name="password" required placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mt-2 mb-3">
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div>
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
</div>
@endsection --}}


@extends('layouts.frontend')
@section('content')

            <!-- ===============================LOGIN SECTION START============== -->
            <div class="container__1">
                <div class="forms__container">
                    <div class="signin__signup">
                        <form action="{{ route('login') }}" method="post" class="sign__in__form">
                            @csrf
                            <h2 class="title__1">Sign in</h2>
                            <div class="input__field__login">
                                <i class="fas fa-user"></i>
                                <input type="email" class="form-control" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email">
                                @if (session('error'))
                                    <strong style="color: red;">{{ session('error') }}</strong>
                                @endif
                            </div>

                            <div class="input__field__login">
                                <i class="fas fa-lock"></i>
                                <input type="password" class="form-control"  name="password" required placeholder="Password">
                            </div>
                            <input type="submit" value="Login" class="btn-main" />
                            <p class="social__text">Or Sign in with social platforms</p>
                            <div class="social__media">
                                <ul class="banner__social">
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-dribbble"></i></a></li>
                                </ul>
                            </div>
                        </form>
                        <form action="#" class="sign__up__form">
                            <h2 class="title">Sign up</h2>
                            <div class="input__field__login">
                                <i class="fas fa-user"></i>
                                <input type="text" placeholder="Username" />
                            </div>
                            <div class="input__field__login">
                                <i class="fas fa-envelope"></i>
                                <input type="email" placeholder="Email" />
                            </div>
                            <div class="input__field__login">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Password" />
                            </div>
                            <input type="submit" class="btn-main" value="Sign up" />
                            <p class="social__text">Or Sign up with social platforms</p>
                            <div class="social__media">
                                <ul class="banner__social">
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-dribbble"></i></a></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panels__container">
                    <div class="panel left__panel">
                        <div class="content">
                            <h3 class="white__title">New here to go sing up?</h3>
                            <p>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis, ex ratione. Aliquid!
                            </p>
                            <button class="btn-black" id="sign-up-btn">
                        Sign up
                      </button>
                        </div>
                        <img src="{{ asset('frontend') }}/img/product/8.png" class="image-T" alt="" />
                    </div>
                    <div class="panel right__panel">
                        <div class="content">
                            <h3 class="white__title">You are registared ?</h3>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum laboriosam ad deleniti.
                            </p>
                            <button class="btn-black" id="sign-in-btn">
                        Sign in
                      </button>
                        </div>
                        <img src="{{ asset('frontend') }}/img/product/9.png" class="image-T" alt="" />
                    </div>
                </div>
            </div>
 
@endsection
 



