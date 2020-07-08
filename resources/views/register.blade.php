@extends('layouts.frontend')

@section ('content')

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form action="{{ route('register') }}" method="POST" class="register-form" id="register-form">
                            @csrf
                            @if (count($errors)> 0)
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $err)
                                    {{ $err }}
                                    @endforeach
                                </div>
                            @endif

                            <div class="form-group">
								<label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
								<input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input required type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                                <input type="text" name="phone" id="phone" placeholder="Your Phone"/>
                            </div>

                            <div class="form-group">
                                <label for="addres"><i class="zmdi zmdi-addres"></i></label>
                                <input type="text" name="addres" id="addres" placeholder="Your addres"/>
                            </div>

                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input required type="password" name="password" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-password"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input required type="password" name="re_password" id="re_password" placeholder="Repeat your password"/>
                            </div>

                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                    </div>
                </div>
            </div>
        </section>

    </div>
{{-- phai kiem tra 2 gias tri nhap vao co giong nhau khong neu giong thi phai nhap lai pass --}}
@endsection
