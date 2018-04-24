@extends('layouts.user')

@section('content')


<!--Form Starts-->
<div class="form-background-2">
   <div class="container">
      <div class="row">
         <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-offset-1 col-xs-10 padding0">
            <div class="form-outer-wrapper">
               <div class="form-heading">
                  <h2>Signup</h2>
                    
                    <div id="msgs">
                      @if(session('success'))
                      <div class="alert alert-success">
                      {{ session('success') }}
                      </div>
                      @endif
                    </div>  

               </div> 

               <div class="form-container form-signup">
                  <form class="form-horizontal" method="POST" action="{{ route('register') }}" id="register_form">
                    {{ csrf_field() }}

                     <div class="form-group">
                        <input type="radio" id="test1" value="user" name="role" checked>
                        <label for="test1">I wanna Yauz a business</label>
                        <input type="radio" id="test2" value="owner" name="role">
                        <label for="test2">I wanna list my Biz (business)</label>
                     </div>

                     <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                       <label for="email">Name</label>
                       <input type="text" name="name" class="form-control form-input" placeholder="Your Name" value="{{ old('name') }}" required>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif         
                                      
                     </div>

                     <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control form-input" placeholder="Your Email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                     </div>

                     <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="email">Password</label>
                        <input type="password" id="password" name="password" class="form-control form-input" placeholder="Password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif       
                                         
                     </div>

                     <div class="form-group">
                        <label for="email">Re-enter Password</label>                     
                        <input type="password" class="form-control form-input" name="password_confirmation" placeholder="Re-enter Password" required>
                     </div>

                     <button id="register_submit_btn" type="submit" class="btn-form">Create Account</button>

                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--Form Ends-->
@endsection

@section('custom_scripts')
 <script src="{{ asset('js/user/user.js') }}"></script>
@endsection