@extends('layouts.admin')
@section('content')

<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Edit Business </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Edit Business</li>
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
   {{-- <section class="content">
      
      <div class="box">

         <div class="custom-tabing"> 
         <ul class="nav nav-tabs responsive" id="myTab">
          <li class="active"><a href="#business_detail">Details</a></li>
          <li><a href="#business_hours">Hours</a></li>
          <li><a href="#business_pictures">Pictures & Videos</a></li>
          <li><a href="#business_description">Description</a></li>
          <li><a href="#business_payment_infomartion">Payment Information</a></li>
          <li><a href="#business_discounts">Discounts</a></li>
          <li><a href="#business_yauzers">Yauzers</a></li>
          <li><a href="#business_specialties">Specialties</a></li>
          <li><a href="#business_info">More Info</a></li>
          <li><a href="#business_interested">Adds</a></li>
        </ul>

        <div class="tab-content responsive">
          <div class="tab-pane active" id="business_detail">
             @include('admin/business_listing/partials/business_form/business_form')         
          </div>
          
          <div class="tab-pane" id="business_hours">
             @if(empty ( $businessHours->id ))
               @include('admin/business_listing/partials/business_hours/show_business_hours')         
             @else
               @include('admin/business_listing/partials/business_hours/updated_business_hours')
             @endif
          </div>
          
          <div class="tab-pane" id="business_pictures">
             @include('admin/business_listing/partials/business_pictures/edit_business_pictures')
          </div>          

          <div class="tab-pane" id="business_description">
             @include('admin/business_listing/partials/business_description/business_description_form')
          </div> 

          <div class="tab-pane" id="business_payment_infomartion">
             @include('admin/business_listing/partials/business_payment/business_payment_form')
          </div>            

          <div class="tab-pane" id="business_discounts">
             @include('admin/business_listing/partials/business_discounts/business_discount_form')
          </div>           

          <div class="tab-pane" id="business_yauzers">
             @include('admin/business_listing/partials/business_yauzers/business_yauzers_listing')
          </div>          

          <div class="tab-pane" id="business_specialties">
             @include('admin/business_listing/partials/business_specialties/business_specialties_listing')
          </div>              

          <div class="tab-pane" id="business_info">
             @include('admin/business_listing/partials/business_info/business_more_info')
          </div>          

          <div class="tab-pane" id="business_interested">
             @include('admin/business_listing/partials/business_interested_in/business_interested_form')
          </div>



        </div>
      </div>

      </div>
     
   </section> --}}
   <!-- /.content -->


<section class="content">
      
      <div class="box">

 <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="option-store x_panel">
            <div id="parentHorizontalTab" class="custom-tabing">
              <ul class="resp-tabs-list nav-tabs hor_1">
                <li>
                  <button type="button" class="tbbtn">Details</button>
                </li>
                <li>
                  <button type="button" class="tbbtn">Hours</button>
                </li>
                <li>
                  <button type="button" class="tbbtn">Pictures & Videos</button>
                </li>
                <li>
                  <button type="button" class="tbbtn">Description</button>
                </li>
                <li>
                  <button type="button" class="tbbtn">Payment Information</button>
                </li>
                <li>
                  <button type="button" class="tbbtn">Discounts</button>
                </li>                
                <li>
                  <button type="button" class="tbbtn">Yauzers</button>
                </li>                
                <li>
                  <button type="button" class="tbbtn">Specialties</button>
                </li>                
                <li>
                  <button type="button" class="tbbtn">More Info</button>
                </li>                
                <li>
                  <button type="button" class="tbbtn">Adds</button>
                </li>
              </ul>
              <div class="resp-tabs-container hor_1">
                
                <div class="mCustomScrollbar">
                  @include('admin/business_listing/partials/business_form/business_form') 
                </div>



                <div class="mCustomScrollbar">
                 @if(empty ( $businessHours->id ))
                   @include('admin/business_listing/partials/business_hours/show_business_hours')         
                 @else
                   @include('admin/business_listing/partials/business_hours/updated_business_hours')
                 @endif             
                </div>


                <div class="mCustomScrollbar">
                  @include('admin/business_listing/partials/business_pictures/edit_business_pictures')
                </div>


                <div class="mCustomScrollbar">
                  @include('admin/business_listing/partials/business_description/business_description_form')
                </div>


                <div class="mCustomScrollbar">
                  @include('admin/business_listing/partials/business_payment/business_payment_form')
                </div>


                <div class="mCustomScrollbar">
                  @include('admin/business_listing/partials/business_discounts/business_discount_form')
                </div>



                <div class="mCustomScrollbar">
                  @include('admin/business_listing/partials/business_yauzers/business_yauzers_listing')
                </div>



                <div class="mCustomScrollbar">
                  @include('admin/business_listing/partials/business_specialties/business_specialties_listing')
                </div>


                <div class="mCustomScrollbar">
                  @include('admin/business_listing/partials/business_info/business_more_info')
                </div>  


                <div class="mCustomScrollbar">
                  @include('admin/business_listing/partials/business_interested_in/business_interested_form')
                </div>

                                        
              </div>
            </div>
          </div>
        </div>


  </div>
</section>        



</aside>
<!-- /.right-side -->
@endsection




@section('custom_scripts')
<script src="http://maps.googleapis.com/maps/api/js?libraries=places" type="text/javascript"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<link href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script src="{{ asset('js/admin/credit_card/jquery.payform.min.js') }}"></script>
<script src="{{ asset('js/admin/credit_card/script.js') }}"></script>
<script src="{{ asset('js/admin/business_listing.js') }}"></script>
@endsection