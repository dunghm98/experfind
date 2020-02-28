@extends('layouts.app')

@section('content')
<!-- Page Content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-8 offset-md-2">

                <!-- Register Content -->
                <div class="account-content">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-7 col-lg-6 login-left">
                            <img src="{{asset('img/client-login.png')}}" class="img-fluid" alt="Doccure Register">
                        </div>
                        <div class="col-md-12 col-lg-6 login-right">
                            <div class="login-header">
                                <h3>Đăng Ký Làm Học Sinh <a href="{{ route('tutor-register') }}">Bạn là gia sư?</a></h3>
                            </div>

                            <!-- Register Form -->
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group form-focus">
                                    <input id="name" type="text" class="floating form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <label class="focus-label">Name</label>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-focus">
                                    <input id="email" type="email" class="floating form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    <input type="hidden" name="user_type" value="2">
                                    <label class="focus-label">Email Address</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-focus">
                                    <input id="password" type="password" class="floating form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <label class="focus-label">Create Password</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-focus">
                                    <input id="password-confirm" type="password" class="floating form-control" name="password_confirmation" required autocomplete="new-password">
                                    <label class="focus-label">Confirm Password</label>
                                </div>
                                <div class="text-right">
                                    <a class="forgot-link" href="{{ route('login') }}">Already have an account?</a>
                                </div>
                                <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">{{ __('Đăng ký') }}</button>
                                <div class="login-or">
                                    <span class="or-line"></span>
                                    <span class="span-or">or</span>
                                </div>
                                <div class="row form-row social-login">
                                    <div class="col-6">
                                        <a href="#" class="btn btn-facebook btn-block"><i class="fab fa-facebook-f mr-1"></i> Login</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="btn btn-google btn-block"><i class="fab fa-google mr-1"></i> Login</a>
                                    </div>
                                </div>
                            </form>
                            <!-- /Register Form -->

                        </div>
                    </div>
                </div>
                <!-- /Register Content -->

            </div>
        </div>

    </div>

</div>
<!-- /Page Content -->
@endsection
