@extends('layouts.app-login')
@section('content')
    <!-- login page start-->
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-12 p-0">
          <div class="login-card login-dark">
            <div>
              <div><a class="logo" href="{{ url('/') }}"><img class="img-fluid for-dark" src="{{ asset('images/logo.png')}}" alt="looginpage"><img class="img-fluid for-light" src="{{ asset('images/logo.png')}}" alt="looginpage"></a></div>
              <div class="login-main">
              <form method="POST" action="{{ route('login') }}">
                        @csrf
                  <h4>Sign in to account </h4>
                  <p>Enter your email & password to login</p>
                  <div class="form-group">
                    <label class="col-form-label">Email Address</label>
                    <input class="form-control" type="text" name="email"  required="" placeholder="Test@gmail.com">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password </label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="password" required="" placeholder="*********">
                      {{-- <div class="show-hide"> <span class="show"></span></div> --}}
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    <div class="checkbox p-0">
                      <input id="checkbox1" type="checkbox">
                      <label class="text-muted" for="checkbox1">Remember password</label>
                    </div>
                    {{-- <a class="link" href="forget-password.html">Forgot password?</a> --}}
                    <div class="forgotpw">
                        <a href="/forgot">Forgot password?</a>
                    </div>
                    <div class="text-end mt-3">

                      <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                    </div>
                  </div>
                  {{-- <h6 class="text-muted mt-4 or">Or Sign in with</h6>

                  <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="sign-up.html">Create Account</a></p> --}}
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
