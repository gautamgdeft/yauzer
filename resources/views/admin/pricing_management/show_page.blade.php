@extends('layouts.admin')
@section('content')
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Pricing Management
      </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Pricing Management</li>
      </ol>
   </section>

  <div id="msgs">
   @if(session('success'))
   <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif
  </div>
   
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <div class="col-md-6">
            <div class="box box-danger">
               <div class="box-header">
                  <h3 class="box-title">Manage Plan Prices</h3>
               </div>
               <form id="price_plans" role="form" action="{{ route('admin.store_plans') }}" enctype="multipart/form-data" method="POST">
                  {{ csrf_field() }}              
                  <div class="box-body">
                     <div class="form-group">
                        <label>Monthly Plan Price:</label>
                        <input type="text" name="monthly_price" class="form-control" value="{{ @sizeof($prices_yauzers->monthly_price)? $prices_yauzers->monthly_price : '' }}">
                     </div>
                     <div class="form-group">
                        <label>Quarterly Plan Price:</label>
                        <input type="text" name="quarterly_price" class="form-control" value="{{ @sizeof($prices_yauzers->quarterly_price)? $prices_yauzers->quarterly_price : '' }}">
                     </div>
                     <div class="form-group">
                        <label>Semi-Annually Plan Price:</label>
                        <input type="text" name="semi_annually_price" class="form-control" value="{{ @sizeof($prices_yauzers->semi_annually_price)? $prices_yauzers->semi_annually_price : '' }}">
                     </div>
                     <div class="form-group">
                        <label>Annually Plan Price:</label>
                        <input type="text" name="annually_price" class="form-control" value="{{ @sizeof($prices_yauzers->annually_price)? $prices_yauzers->annually_price : '' }}">
                     </div>
                  </div>
                  <div class="box-footer">
                     <button id="plan-submit-btn" type="submit" class="btn btn-primary">Update</button>
                  </div>
               </form>
            </div>
         </div>
         <!-- /.col (left) -->
         <div class="col-md-6">
            <div class="box box-primary">
               <div class="box-header">
                  <h3 class="box-title">Manage Yauzers</h3>
               </div>
               <form id="manage_yauzers" role="form" action="{{ route('admin.store_plans') }}" enctype="multipart/form-data" method="POST">
                  {{ csrf_field() }}                                
                  <div class="box-body">
                     <div class="form-group">
                        <label>No of yauzers to qualify premium</label>
                        <input type="text" name="yauzer" class="form-control" value="{{ @sizeof($prices_yauzers->yauzer)? $prices_yauzers->yauzer : '' }}">
                     </div>                     
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                     <button id="yauzer-submit-btn" type="submit" class="btn btn-primary">Update</button>
                  </div>
               </form>
            </div>
            <!-- /.box -->
         </div>
         <!-- /.col (right) -->
      </div>
      <!-- /.row -->                    
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->
@endsection
@section('custom_scripts')
<script type="text/javascript">
      
   //Adding-Validations-On-Home-Page-CMS
   $('#price_plans').validate({
   
   onfocusout: function (valueToBeTested) {
     $(valueToBeTested).valid();
   },
   
   highlight: function(element) {
     $('element').removeClass("error");
   },
   
   rules: {
     
     "monthly_price": {
       price: true
     },
     'quarterly_price': {
       price: true
     },
     'semi_annually_price': {
       price: true
     },
     'annually_price': {
       price: true
     },      
     valueToBeTested: {
         required: true,
     }
   
   },
   });   
   
   
     //Submitting Register Form 
     $('#plan-submit-btn').click(function()
     {
       if($('#price_plans').valid())
       {
         $('#plan-submit-btn').prop('disabled', true);
         $('#price_plans').submit();
       }else{
         return false;
       }
     });    
   
   //Adding-Validations-On-Business-Page-CMS
   $('#manage_yauzers').validate({
   onfocusout: function (valueToBeTested) {
     $(valueToBeTested).valid();
   },
   
   highlight: function(element) {
     $('element').removeClass("error");
   },
   
   rules: {
     
     "yauzer": {
     	price: true
     },
   
     valueToBeTested: {
         required: true,
     }
   
   },
   });   
   
   
     //Submitting Register Form 
     $('#yauzer-submit-btn').click(function()
     {
       if($('#manage_yauzers').valid())
       {
         $('#yauzer-submit-btn').prop('disabled', true);
         $('#manage_yauzers').submit();
       }else{
         return false;
       }
     });  

	  //Only-Character-Add-Method
	  $.validator.addMethod("price", function (value, element) {
	  return this.optional(element) || /^\d+(?:[.,]\d+)*$/i.test(value);
	  }, "Only integer are allowed.");     
   
</script>
@endsection