@extends('layouts.user')

@section('content')

<div class="form-background">
  <div class="container">
    <div class="row">
      <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-offset-1 col-xs-10 padding0">
        <div class="form-outer-wrapper">

          <div class="form-heading">
            <h2>Reset Password</h2>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
                        
          </div>

          <div class="form-container">
            <form id="reset_password_email_form" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control form-input" placeholder="Enter Your Email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

              </div>

              <button id="reset_password_btn" type="submit" class="btn-form">Send Password Reset Link<i class="fa fa-arrow-circle-right"></i></button>

            </form>
          </div>

        </div>  
      </div>
    </div>
  </div>
</div>

@endsection

@section('custom_scripts')
 <script src="{{ asset('js/user/user.js') }}"></script>
@endsection