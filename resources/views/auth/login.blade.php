@extends('layouts.user')

@section('content')


<!-- Login Form Starts -->
<div class="form-background" style="background-image: url({{ asset('uploads/siteCMSAvatars/'.$loginSignImage->login_bg_image) }});">
  <div class="container">
    <div class="row">
      <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-offset-1 col-xs-10 padding0">
        <div class="form-outer-wrapper">
          <div class="form-heading">
            <h2>{{ (\Request::route()->getName() == 'owner.login') ? 'Log in for Business' : 'Login' }}</h2>

              <div id="msgs">
                @if(session('success'))
                <div class="alert alert-success">
                {{ session('success') }}
                </div>
                @endif               

                @if(session('danger'))
                <div class="alert alert-danger">
                {{ session('danger') }}
                </div>
                @endif
              </div> 

          </div>
          <div class="form-container">
            <form id="login-form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control form-input" placeholder="Enter Your Email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

              </div>


              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control form-input" placeholder="Enter Your Password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

              </div>


              <button id="login_submit_btn" type="submit" class="btn-form">Login<i class="fa fa-arrow-circle-right"></i></button>
              <a href="{{ route('password.request') }}" class="fgt-pswd">Forgot password?</a>
            </form>

          </div>

          <div class="other-accounts">
            <div class="accounts-heading">
              <h5>Login with other accounts</h5>
            </div>

            <div class="col-sm-6 accounts-btn padding0">
              <button type="button" class="fb-btn"><i class="fa fa-facebook"></i><span>Facebook</span></button>
            </div>

            <div class="col-sm-6 accounts-btn padding0">
              <button type="button" class="twitter-btn"><i class="fa fa-twitter"></i><span>Twitter</span></button>
            </div>

            <div class="col-sm-12 form-separator padding0">
              <div class="hr-left">
                <hr />
              </div>
              <div class="or">
                <h5>OR</h5>
              </div>
              <div class="hr-left">
                <hr />
              </div>
              <button onclick="location.href='{{ route('register') }}'" type="button" class="btn-signup">SignUp</button>
            </div>

          </div>

        </div>  
      </div>
    </div>
  </div>
</div>

<!--form ends here -->


@endsection

@section('custom_scripts')
 <script src="{{ asset('js/user/user.js') }}"></script>
@endsection