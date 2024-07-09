@extends('layouts.app-login')
@section('content')

    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-12 p-0">
          <div class="login-card login-dark">
            <div>
              <div>
                <a class="logo" href="{{ url('/') }}">
                    <img class="img-fluid for-dark" src="{{ asset('images/logo.png')}}" alt="looginpage">
                    <img class="img-fluid for-light" src="{{ asset('images/logo.png')}}" alt="looginpage">
                </a>
            </div>
              <div class="login-main">
              <form method="POST" action="{{ route('sendmail') }}">
                        @csrf
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                  <h4>Reset Link</h4>
                  <p>Enter Your Email To Create A New Password</p>
                  <div class="form-group">
                    <label class="col-form-label">Email Address</label>

                        @error('email')
                            <span class="error" style="color:red">**{{ $message }}</span>
                        @enderror

                    <input class="form-control" type="text" name="email"  required="" placeholder="Email...">
                  </div>

                    <div class="text-end mt-3">
                      <button class="btn btn-primary btn-block w-100" type="submit">Click To get a Reset Link</button>
                    </div>
                    <br>
                <a href="/login">Back
                    {{-- <i class="fa-solid fa-arrow-left"></i> --}}
                </a>

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
