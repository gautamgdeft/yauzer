@extends('layouts.admin')
@section('content')


<aside class="right-side">
 <!-- Content Header (Page header) -->
 <section class="content-header">
  <h1> Edit Yauzer </h1>
  <ol class="breadcrumb">
   <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Edit Yauzer</li>
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
   <form id="edit-yauzer-form" role="form" action="{{ route('admin.update_yauzer',['yauzer_id' => $yauzer->id, 'slug' => $slug]) }}" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}

    <input type="hidden" name="business_id" value="{{ $business->id }}"> 
    <input type="hidden" name="user_id" value="34"> 

    <div class="box-body">

     <div class="form-group{{ $errors->has('business_name') ? ' has-error' : '' }}">
      <label for="business_name">Business Name</label>
      <input type="text" class="form-control" id="business_name" name="business_name" value="{{ $business->name }}" required="required" disabled="disabled">

      @if ($errors->has('business_name'))
      <span class="help-block">
        <strong>{{ $errors->first('business_name') }}</strong>
      </span>
      @endif

    </div>               

    <div class="form-group{{ $errors->has('yauzer') ? ' has-error' : '' }}">
      <label for="yauzer">Yauzer</label>
      <textarea name="yauzer" rows="5" cols="50" class="form-control valid" required="required">{{ $yauzer->yauzer }}</textarea>

      @if ($errors->has('yauzer'))
      <span class="help-block">
        <strong>{{ $errors->first('yauzer') }}</strong>
      </span>
      @endif

    </div>               


    <div class="form-group{{ $errors->has('rating') ? ' has-error' : '' }}">
      <label for="rating">Rating</label>
      <input id="input-21e" value="{{ $yauzer->rating }}" type="text" class="form-control rating" data-min=0 data-max=5 data-step=1 data-size="xs" name="rating" title="" required="required">

      @if ($errors->has('rating'))
      <span class="help-block">
        <strong>{{ $errors->first('rating') }}</strong>
      </span>
      @endif

    </div>


  </div>
  <!-- /.box-body -->
  <div class="box-footer">
   <button id="update-yauzer-btn" type="submit" class="btn btn-primary">Submit</button>
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

 <script type="text/javascript">
   
   $(document).ready(function()   
   {
      //Adding-Validations-Yauzer-Form
      $('#edit-yauzer-form').validate({
      onfocusout: function (valueToBeTested) {
          $(valueToBeTested).valid();
      },

      highlight: function(element) {
          $('element').removeClass("error");
        },

      rules: {
          
          valueToBeTested: {
              required: true,
          }

        },
      });

  //Submitting New Yauzer
  $('#update-yauzer-btn').click(function()
  {
    if($('#edit-yauzer-form').valid())
    {
      $('#update-yauzer-btn').prop('disabled', true);
      $('#edit-yauzer-form').submit();
    }else{
      return false;
    }
  });  


   });

 </script> 

@endsection