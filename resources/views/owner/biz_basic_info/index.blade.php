@extends('layouts.owner')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Biz Basic Information  </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Biz Basic Information</li>
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
             <form id="edit-business-form" role="form" action="{{ route('owner.update_biz_basic_info',['slug' => $business->slug]) }}" enctype="multipart/form-data" method="POST">
              {{ csrf_field() }}
                <div class="box-body">

                   <!--Hidden Fields-->
                   <input type="hidden" name="latitude" id="latitude" value="{{ $business->latitude }}">
                   <input type="hidden" name="longitude" id="longitude" value="{{ $business->longitude }}">

                   <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{ $business->name }}" required="required">

                      @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                      @endif

                   </div>               

                   <div class="form-group{{ $errors->has('business_category') ? ' has-error' : '' }}">
                      <label for="business_category">Business Category</label>
                      <select class="form-control" id="business_category" name="business_category" required="required">
                      <option value="">Choose Category</option>  
                      @if(!is_null($business_categories))
                        @foreach($business_categories as $loopingCategories)  
                        <option value="{{ $loopingCategories->id }}" @if($loopingCategories->id == $business->business_category) selected="selected" @endif >{{ $loopingCategories->name }}</option>
                        @endforeach
                      @endif
                      </select>  

                      @if ($errors->has('business_category'))
                        <span class="help-block">
                            <strong>{{ $errors->first('business_category') }}</strong>
                        </span>
                      @endif

                   </div>

                   <div id="subcategory" class="form-group{{ $errors->has('name') ? ' has-error' : '' }} @if(@sizeof($business->category->business_subcategories) == 0) hide @endif">
                      <label for="name">Business Subcategory</label>
                      <select id="business_subcategory" class="businessSubcategory chosen-select form-control" name="business_subcategory[]" multiple="true">
                        
                         @if(@sizeof($business->category->business_subcategories))
                         @foreach($business->category->business_subcategories as $loopingsubcategories)

                          @if(@sizeof($subcategoryArray))
                           <option value="{{ $loopingsubcategories->id }}" @if(in_array($loopingsubcategories->id, $subcategoryArray)) selected="selected" @endif>{{ $loopingsubcategories->name }}</option>
                          @else
                           <option value="{{ $loopingsubcategories->id }}">{{ $loopingsubcategories->name }}</option>
                          @endif
                      
                         
                        @endforeach
                        @endif
                        

                      </select>  

                      @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                      @endif

                   </div>                                         

                   <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                      <label for="country">Country</label>
                      <select class="form-control" id="country" name="country" value="{{ old('country') }}" required="required">
                      <option value="">Choose Country</option>  
                      @if(!is_null($country))
                        @foreach($country as $loopingCountries)  
                        <option value="{{ $loopingCountries }}" @if($loopingCountries == $business->country) selected="selected" @endif >{{ $loopingCountries }}</option>
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
                      <input type="text" class="form-control" id="address" name="address" value="{{ $business->address }}" required="required">

                      @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                      @endif

                   </div>


                   <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                      <label for="address">City</label>
                      <input type="text" class="form-control" id="city" name="city" value="{{ $business->city }}" required="required">

                      @if ($errors->has('city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                      @endif

                   </div>


                   <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                      <label for="address">State</label>
                      <input type="text" class="form-control" id="state" name="state" value="{{ $business->state }}" required="required">

                      @if ($errors->has('state'))
                        <span class="help-block">
                            <strong>{{ $errors->first('state') }}</strong>
                        </span>
                      @endif

                   </div>

                   <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                      <label for="zipcode">Zipcode</label>
                      <input type="text" class="form-control" id="zipcode" name="zipcode" value="{{ $business->zipcode }}" required="required">

                      @if ($errors->has('zipcode'))
                        <span class="help-block">
                            <strong>{{ $errors->first('zipcode') }}</strong>
                        </span>
                      @endif

                   </div>                                                                                                                          

                   <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                      <label for="avatar">Business Main Image</label>
                      <input type="file" id="avatar" name="avatar" class="form-control" onchange="ValidateSingleInput(this);">

                      @if ($errors->has('avatar'))
                        <span class="help-block">
                            <strong>{{ $errors->first('avatar') }}</strong>
                        </span>
                      @endif

                      <img id="image_src" class="img-circle" src="/uploads/businessAvatars/{{ $business->avatar }}" style="height: 45px; width: 45px;">
                   </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                   <button id="submit-business-form-btn" type="submit" class="btn btn-primary">Update</button>
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

