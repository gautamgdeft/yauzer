<!DOCTYPE html>
<html class="bg-black">
    <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>        
                <link href="{{ asset('css/app.css') }}" rel="stylesheet">
                <link href="{{ asset('css/admin/AdminLTE.css') }}" rel="stylesheet">
    </head>

    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Admin Login</div>
            <form method="POST" action="{{ route('admin.login.submit') }}">
                {{ csrf_field() }}
                <div class="body bg-gray">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                     
                     <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        
                     <input id="password" type="password" class="form-control" name="password" required placeholder="Password">

                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif

                    </div> 

                    <div class="form-group">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </div>
                </div>

                <div class="footer">
                        <button type="submit" class="btn bg-olive btn-block">
                            Sign me in
                        </button>

                        <p><a class="btn btn-link" href="{{ route('admin.password.request') }}">Forgot Your Password?</a></p>
                </div> 

            </form>

        </div>     

    </body>
</html>