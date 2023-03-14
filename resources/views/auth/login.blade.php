@extends('layouts.appLogin')

@section('content')
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>
    <div class="login_wrapper ">
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if (Session::has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="animate form login_form ">
            <section class="login_content">
                @php
                    if (isset($_COOKIE['login_email']) && isset($_COOKIE['login_pass'])) {
                        $login_email = $_COOKIE['login_email'];
                        $login_pass = $_COOKIE['login_pass'];
                        $is_remember = "checked='checked'";
                    } else {
                        $login_email = '';
                        $login_pass = '';
                        $is_remember = '';
                    }
                @endphp

                {{-- <form method="POST" action="{{ route('login') }}"> --}}
                <form method="POST" action="{{ route('login.custom') }}">
                    @csrf
                    <h1>Login</h1>
                    <div class="form-group row">
                        <input id="email" type="email" placeholder="Email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ $login_email }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <input id="password" type="password" value="{{ $login_pass }}" placeholder="Password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}

                    @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                            <strong style="color:red;">{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                    @endif

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" {{ $is_remember }} name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="form-group row">

                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif

                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">New to site?
                            <a href="#signup" class="to_register"> Create Account </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                    </div>
                </form>
            </section>
        </div>
        {{-- animate form login_form --}}

        <div id="register" class="animate form registration_form ">
            <section class="login_content">
                <form method="POST" action="{{ route('register.custom') }}">

                    <h1>Create Account</h1>
                    @csrf
                    <div>
                        <input id="name" placeholder="Username" type="text"
                            class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <input id="email" type="email" placeholder="Email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div>
                        <input id="password" type="password" placeholder="Password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <input id="password-confirm" placeholder="password-confirm" type="password" class="form-control"
                            name="password_confirmation" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}

                    @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                            <strong style="color:red;">{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                    @endif
                    <div>
                        <div class="form-group row mb-0 mt-2 ">
                            <div class="col-md-6 offset-md-4 ">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                        </p>
                        <div class="clearfix"></div>
                        <br />
                    </div>
                </form>
            </section>
        </div>


        {{-- login_wrapper --}}
    </div>
@endsection
