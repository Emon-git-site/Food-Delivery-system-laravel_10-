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
                        <input type="email" class="form-control" name="email" :value="old('email')" required autofocus
                            autocomplete="username" placeholder="Email">
                        @if (session('error'))
                            <strong style="color: red;">{{ session('error') }}</strong>
                        @endif
                    </div>

                    <div class="input__field__login">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="form-control" name="password" required placeholder="Password">
                    </div>
                    <input type="submit" value="Login" class="btn-main" />
                    <p class="social__text">Or Sign in with social platforms</p>
                    <div class="social__media">
                        <ul class="banner__social">
                            <li><a class="icon social__icon" target="_blank" href="#"><i
                                        class="fab fa-facebook-f"></i></a></li>
                            <li><a class="icon social__icon" target="_blank" href="#"><i
                                        class="fab fa-twitter"></i></a></li>
                            <li><a class="icon social__icon" target="_blank" href="#"><i
                                        class="fab fa-linkedin-in"></i></a></li>
                            <li><a class="icon social__icon" target="_blank" href="#"><i
                                        class="fab fa-instagram"></i></a></li>
                            <li><a class="icon social__icon" target="_blank" href="#"><i
                                        class="fab fa-dribbble"></i></a></li>
                        </ul>
                    </div>
                </form>
                <form action="{{ route('register') }}" class="sign__up__form" method="POST">
                    @csrf
                    <h2 class="title">Sign up</h2>
                    <div class="input__field__login">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" placeholder="Username" />
                    </div>
                    <div class="input__field__login">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" />
                    </div>
                    <div class="input__field__login">
                        <i class="fas fa-phone"></i>
                        <input type="text" name="phone" placeholder="Phone" />
                    </div>
                    <div class="input__field__login">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" />
                    </div>
                    <div class="input__field__login">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password_confirmation" placeholder="Confirmed Password" />
                    </div>
                    <input type="submit" class="btn-main" value="Sign up" />
                    <p class="social__text">Or Sign up with social platforms</p>
                    <div class="social__media">
                        <ul class="banner__social">
                            <li><a class="icon social__icon" target="_blank" href="#"><i
                                        class="fab fa-facebook-f"></i></a></li>
                            <li><a class="icon social__icon" target="_blank" href="#"><i
                                        class="fab fa-twitter"></i></a></li>
                            <li><a class="icon social__icon" target="_blank" href="#"><i
                                        class="fab fa-linkedin-in"></i></a></li>
                            <li><a class="icon social__icon" target="_blank" href="#"><i
                                        class="fab fa-instagram"></i></a></li>
                            <li><a class="icon social__icon" target="_blank" href="#"><i
                                        class="fab fa-dribbble"></i></a></li>
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
@section('script')
    <script type="text/javascript">
        var errors = @json($errors->all());

        document.addEventListener('DOMContentLoaded', function() {
            if (errors.length > 0) {
                errors.forEach(function(error) {
                    toastr.error(error);
                });
            }
        });
    </script>
@endsection
