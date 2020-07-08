@extends('layouts.frontend')

@section ('content')


    <div class="main">


        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="{{ asset('/register')}}" class="signup-image-link">Create an account</a>
                    </div>
{{-- {{ $request->session()->get('message') }} --}}
                    <div class="signin-form">
                        <h2 class="form-title">Sign In</h2>

                        {{-- @if (Session::has('flags') && Session::has('message'))
                            <div class="alert alert-{{ Session::get('flags') }}"> {{ Session::get('message') }}</div>
                        @endif --}}

                        <form action="{{ route('index.dangnhap') }}" method="POST" class="register-form" id="login-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @csrf
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input required type="text" name="email" id="email" placeholder="Your Mail"/>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input required type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember" id="remember" class="agree-term" />
                                <label for="remember" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
