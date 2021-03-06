@extends('auth.layouts.main')
@section('content')
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="{{ asset('auth') }}/images/signin-image.jpg" alt="sing up image"></figure>
                    <a href="{{route('signup')}}" class="signup-image-link">Create an account</a>
                </div>
                <div class="signin-form">
                    <h2 class="form-title">Sign in</h2>
                    @if(Session::has('msg'))
                        <p style="color: red">{{Session::get('msg')}}</p>
                        <br>
                    @endif
                    <form method="POST" class="register-form" id="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            @if(Session::has('email'))
                                <input type="email" name="email" id="your_name" placeholder="Your email"
                                       value="{{Session::get('email')}}"/>
                            @else
                                <input type="email" name="email" id="your_name" placeholder="Your email"
                                       value="{{old('email')}}"/>
                            @endif
                            @error('email')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="your_pass" placeholder="Password"/>
                            @error('password')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term"/>
                            <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember
                                me</label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                        </div>
                    </form>
                    <div class="social-login">
                        <span class="social-label">Or login with</span>
                        <ul class="socials">
                            <li><a href="{{route('social.login', ['social' => 'facebook'])}}"><i
                                        class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            <li><a href="{{route('social.login', ['social' => 'twitter'])}}"><i
                                        class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                            <li><a href="{{route('social.login', ['social' => 'google'])}}"><i class="display-flex-center zmdi zmdi-google"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
