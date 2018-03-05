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
         <div class="header">Admin Reset Password</div>
         <form class="form-horizontal" method="POST" action="{{ route('admin.password.email') }}">
            {{ csrf_field() }}

            <div class="body bg-gray">
                    @if (session('status'))
                      <span class="help-block">
                      <strong> {{ session('status') }}</strong>
                      </span>
                    @endif                  
               <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                  @if ($errors->has('email'))
                  <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif                
               </div>
            </div>
            <div class="footer">
               <button type="submit" class="btn bg-olive btn-block">
               Send Password Reset Link
               </button>
            </div>
         </form>
      </div>
   </body>