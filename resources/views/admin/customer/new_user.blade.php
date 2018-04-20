@extends('layouts.admin')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Add New User </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Add New User</li>
      </ol>
   </section>

                 @if(session('success'))
                  <div class="alert alert-success">
                  {{ session('success') }}
                  </div>
                 @endif

   <!-- Main content -->
   <section class="content">
      <div class="box box-primary">
         <!-- form start -->
         <form id="customer-form" role="form" action="{{ route('admin.store_user') }}" enctype="multipart/form-data" method="POST">
         	{{ csrf_field() }}
            <div class="box-body">
               <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required="required">

                  @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif

               </div>               

               <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email">Email Address</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required="required">

      			      @if ($errors->has('email'))
      			        <span class="help-block">
      			            <strong>{{ $errors->first('email') }}</strong>
      			        </span>
      			      @endif

               </div>

               <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" value="" required="required">

                  @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif

               </div>

               <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                  <label for="country">Country</label>
                  <select class="form-control" id="country" name="country" value="{{ old('country') }}" required="required">
                  <option value="">Choose Country</option>  
                  @if(!is_null($country))
                    @foreach($country as $loopingCountries)  
                    <option value="{{ $loopingCountries }}">{{ $loopingCountries }}</option>
                    @endforeach
                  @endif
                  </select>  

                  @if ($errors->has('country'))
                    <span class="help-block">
                        <strong>{{ $errors->first('country') }}</strong>
                    </span>
                  @endif

               </div>               

               <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                  <label for="address">Address</label>
                  <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required="required">

                  @if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                  @endif

               </div>


               <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                  <label for="address">City</label>
                  <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required="required">

                  @if ($errors->has('city'))
                    <span class="help-block">
                        <strong>{{ $errors->first('city') }}</strong>
                    </span>
                  @endif

               </div>


               <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                  <label for="address">State</label>
                  <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}" required="required">

                  @if ($errors->has('state'))
                    <span class="help-block">
                        <strong>{{ $errors->first('state') }}</strong>
                    </span>
                  @endif

               </div>

               <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                  <label for="zipcode">Zipcode</label>
                  <input type="text" class="form-control" id="zipcode" name="zipcode" value="{{ old('zipcode') }}" required="required">

                  @if ($errors->has('zipcode'))
                    <span class="help-block">
                        <strong>{{ $errors->first('zipcode') }}</strong>
                    </span>
                  @endif

               </div>

               <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                  <label for="phone_number">Phone Number</label>
                  <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required="required">

                  @if ($errors->has('phone_number'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone_number') }}</strong>
                    </span>
                  @endif

               </div>                                                                                                             

               <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                  <label for="avatar">Profile Image</label>
                  <input type="file" id="avatar" name="avatar" class="form-control" onchange="ValidateSingleInput(this);" required="required">

                  @if ($errors->has('avatar'))
      			        <span class="help-block">
      			            <strong>{{ $errors->first('avatar') }}</strong>
      			        </span>
		              @endif

                  <img id="image_src" class="img-circle" src="/uploads/avatars/default.png" style="height: 45px; width: 45px;">
               </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
               <button id="submit-customer-btn" type="submit" class="btn btn-primary">Submit</button>
            </div>
         </form>
      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->
@endsection




@section('custom_scripts')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0fh0XyC8Pr0xbdKsTfu8Zl40u8fiqOpQ&libraries=places"></script>
<script src="{{ asset('js/admin/customer.js') }}"></script>
@endsection