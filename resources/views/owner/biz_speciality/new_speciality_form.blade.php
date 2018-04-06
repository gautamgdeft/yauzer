@extends('layouts.owner')
@section('content')


<aside class="right-side">
 <!-- Content Header (Page header) -->
 <section class="content-header">
  <h1> Add New Speciality </h1>
  <ol class="breadcrumb">
   <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Add New Speciality</li>
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
   <form id="speciality-form" role="form" action="{{ route('owner.store_speciality',['slug' => $slug]) }}" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}

    <input type="hidden" name="business_id" value="{{ $business->id }}"> 
    
    <div class="box-body">

     <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name" required="required">

      @if ($errors->has('name'))
      <span class="help-block">
        <strong>{{ $errors->first('name') }}</strong>
      </span>
      @endif

    </div>               
  </div>
  <!-- /.box-body -->


  <div class="box-footer">
   <button id="speciality-submit-btn" type="submit" class="btn btn-primary">Submit</button>
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
      $('#speciality-form').validate({
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

  //Submitting New Yauzer
  $('#speciality-submit-btn').click(function()
  {
    if($('#speciality-form').valid())
    {
      $('#speciality-submit-btn').prop('disabled', true);
      $('#speciality-form').submit();
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