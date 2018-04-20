@extends('layouts.admin')
@section('content')


<aside class="right-side">
 <!-- Content Header (Page header) -->
 <section class="content-header">
  <h1> Edit Speciality </h1>
  <ol class="breadcrumb">
   <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Edit Speciality</li>
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
   <form id="edit-speciality-form" role="form" action="{{ route('admin.update_speciality',['speciality_id' => $speciality->slug, 'slug' => $slug]) }}" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}

    <input type="hidden" name="business_id" value="{{ $business->id }}"> 
    
    <div class="box-body">

     <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name" required="required" value="{{ $speciality->name }}">

      @if ($errors->has('name'))
      <span class="help-block">
        <strong>{{ $errors->first('name') }}</strong>
      </span>
      @endif

    </div>      


    <div class="form-group">
      <label for="name">Status</label>
      <input type="radio" name="status" class="form-control" value="{{ $speciality->status }}" @if($speciality->status == true) checked="checked" @endif> Active<br>
      <input type="radio" name="status" class="form-control" value="{{ $speciality->status }}" @if($speciality->status == false) checked="checked" @endif> Inactive<br>
    </div>               
  </div>
  <!-- /.box-body -->


  <div class="box-footer">
   <button id="edit-speciality-btn" type="submit" class="btn btn-primary">Submit</button>
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
      $('#edit-speciality-form').validate({
      onfocusout: function (valueToBeTested) {
          $(valueToBeTested).valid();
      },

      highlight: function(element) {
          $('element').removeClass("error");
        },

      rules: {

          'name': {
           character_with_space: true,
          },
          valueToBeTested: {
              required: true,
          }

        },
      });

  //Submitting Speciality
  $('#edit-speciality-btn').click(function()
  {
    if($('#edit-speciality-form').valid())
    {
      $('#edit-speciality-btn').prop('disabled', true);
      $('#edit-speciality-form').submit();
    }else{
      return false;
    }
  });

  //Only-Character-Add-Method
  $.validator.addMethod("character_with_space", function (value, element) {
  return this.optional(element) || /^[a-zA-Z .]+$/i.test(value);
  }, "Only letters are allowed.");   


   }); //End-Ready

 </script> 

@endsection