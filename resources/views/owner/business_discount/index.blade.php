@extends('layouts.owner')
@section('content')

<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Biz Discounts </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Biz Discounts</li>
      </ol>
   </section>
                 <div id="msgs">
                   @if(session('success'))
                    <div class="alert alert-success">
                    {{ session('success') }}
                    </div>
                   @endif
                 </div>  


   <section class="content">
      <div class="box">
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="option-store x_panel">


        <div class="box-header discounts-1">
          <h3>Discounts</h3>
        </div>                      
             <!-- form start -->

             <form id="edit-business-discount-form" role="form" action="{{ route('owner.update_business_discount',['slug' => $business->slug]) }}" enctype="multipart/form-data" method="POST">
              {{ csrf_field() }}
                <div class="box-body">


                   <div class="form-group{{ $errors->has('discount_title') ? ' has-error' : '' }}">
                      <label for="discount_title">Discount Title</label>
                      <input type="text" class="form-control" id="discount_title" name="discount_title" value="@if(@sizeof($businessDiscountInfo->discount_title)) {{ $businessDiscountInfo->discount_title }} @endif" required="required">

                      @if ($errors->has('discount_title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('discount_title') }}</strong>
                        </span>
                      @endif

                   </div>                     

                   <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                      <label for="description">Discount Description</label>
                      <textarea name="description" rows="5" cols="50" class="form-control" required="required">@if(@sizeof($businessDiscountInfo->description)){{ $businessDiscountInfo->description }}@endif</textarea>

                      @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                      @endif

                   </div>                     

                    <div class="form-group{{ $errors->has('valid_thru') ? ' has-error' : '' }}">
                      <label for="valid_thru">Discount Valid Thru</label>
                      <input type="text" class="form-control" id="valid_thru" name="valid_thru" value="@if(@sizeof($businessDiscountInfo->valid_thru)) {{ date('m/d/Y', strtotime($businessDiscountInfo->valid_thru)) }} @endif" required="required">

                      @if ($errors->has('valid_thru'))
                        <span class="help-block">
                            <strong>{{ $errors->first('valid_thru') }}</strong>
                        </span>
                      @endif

                   </div>               

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                   <button id="update-discount-form-btn" type="submit" class="btn btn-primary">Update</button>
                </div>
             </form>


            </div>
         </div>
      </div>
   </section>
</aside>
<!-- /.right-side -->
@endsection