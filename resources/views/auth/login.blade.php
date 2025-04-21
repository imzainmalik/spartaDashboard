<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sparata Dashboard</title>
    @include('layouts.includes.compatibility')
    @include('layouts.includes.style')
</head>

<body class="scrolllenis home" id="top">
    <!-- scroll -->
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>
    <!-- scroll -->
    <section class="signinSec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="text-center">
                        <a href="#"><img src="{{ asset('assets/images/logo1.png') }}" class="img-fluid"
                                alt=""></a>
                    </div>
                    <div class="signupBox">
                        <h3>Login </h3>
                        {{-- <div class="newUser">
                                <a href="#">New user?</a>
                                <a href="#">Create an acount </a>
                            </div> --}}
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="text" placeholder="Email" class="@error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="alert invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Password"
                                    class="@error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="formgetPaasss">
                                <a href="#">Forgot password?</a>
                                <button class="themeBtn" type="submit">Sign In</button>
                            </div>
                            {{-- <div class="ors"><span>or</span></div> --}}
                            {{-- <div class="googleFlex">
                                    <a href="#"><img src="assets/images/google.png" class="img-fluid" alt="">
                                        Google</a>
                                    <a href="#"><img src="assets/images/facebook.png" class="img-fluid" alt="">
                                        Facebook</a>
                                </div> --}}
                            {{-- <p>Protected by reCAPTCHA and subject to the <a href="#">Cuboid Privacy Policy</a>
                                    and <a href="#">Terms of
                                        Service.</a></p> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.includes.scripts')
</body>

</html>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
