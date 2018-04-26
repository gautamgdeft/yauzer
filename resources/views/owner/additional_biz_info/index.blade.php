@extends('layouts.owner')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Additional Biz Information  </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Additional Biz Information</li>
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
             <form id="edit-additional-biz-form" role="form" action="{{ route('owner.update_biz_additional_info',['slug' => $business->slug]) }}" enctype="multipart/form-data" method="POST">
              {{ csrf_field() }}
                <div class="box-body">             

                   <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email">Email Address</label>
                      <input type="email" class="form-control" id="email" name="email" value="{{ $business->email }}" required>

                      @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                      @endif

                   </div>                                      

                   <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                      <label for="phone_number">Phone Number</label>
                      <input type="text" class="form-control input-medium bfh-phone" data-country="US" id="phone_number" name="phone_number" data-number="{{ $business->phone_number }}" value="{{ $business->phone_number }}" required="required">

                      @if ($errors->has('phone_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone_number') }}</strong>
                        </span>
                      @endif

                   </div>                     

                   <div class="form-group{{ $errors->has('fax_number') ? ' has-error' : '' }}">
                      <label for="fax_number">Fax Number</label>
                      <input type="text" class="form-control" id="fax_number" name="fax_number" value="{{ $business->phone_number }}" required="required">

                      @if ($errors->has('fax_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('fax_number') }}</strong>
                        </span>
                      @endif

                   </div>                

                   <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                      <label for="website">Website</label>
                      <input type="text" class="form-control" id="website" name="website" value="{{ $business->website }}" required="required">

                      @if ($errors->has('website'))
                        <span class="help-block">
                            <strong>{{ $errors->first('website') }}</strong>
                        </span>
                      @endif

                   </div>                                                                                                             
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                   <button id="additional-biz-btn" type="submit" class="btn btn-primary">Update</button>
                   <a href="{{ URL::previous() }}" class="btn btn-warning">Go Back</a>
                </div>
             </form>            
      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->
@endsection