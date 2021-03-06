@extends('layouts.owner')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Biz Payment Information  </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Biz Payment Information</li>
      </ol>
   </section>

                 @if(session('success'))
                  <div class="alert alert-success">
                  {{ session('success') }}
                  </div>
                 @endif                 

                 @if(session('error'))
                  <div class="alert alert-danger">
                  {{ session('error') }}
                  </div>
                 @endif

   <!-- Main content -->
   <section class="content">
      <div class="box box-primary">

             <!-- form start -->
             <form id="payment-subscription-form" role="form" action="{{ route('owner.process_payment') }}" enctype="multipart/form-data" method="POST">
              {{ csrf_field() }}
                <div class="box-body">
                <div class="form-group">
                      <label for="name">Select Business-Membership Plan</label>
{{--                       <select class="form-control" name="payment_plan">

                        @if(@sizeof($plans))
                        <option value="Annually_{{ $plans->annually_price }}_{{ Auth::User()->business->id }}">Annually ${{ $plans->annually_price }}</option>
                        <option value="Semi-Annually_{{ $plans->annually_price }}_{{ Auth::User()->business->id }}">Semi-Annually ${{ $plans->semi_annually_price }}</option>
                        <option value="Quarterly_{{ $plans->quarterly_price }}_{{ Auth::User()->business->id }}">Quarterly ${{ $plans->quarterly_price }}</option>
                        <option value="Monthly_{{ $plans->monthly_price }}_{{ Auth::User()->business->id }}">Monthly ${{ $plans->monthly_price }}</option>
                        @endif
                      </select> --}}
                <div class="radio">
                 <label><input value="Annually_{{ $plans->annually_price }}_{{ Auth::User()->business->id }}" type="radio" name="payment_plan" checked="checked">Annually ${{ $plans->annually_price }}</label>
                </div>                
                <div class="radio">
                 <label><input value="Semi-Annually_{{ $plans->annually_price }}_{{ Auth::User()->business->id }}" type="radio" name="payment_plan">Semi-Annually ${{ $plans->semi_annually_price }}</label>
                </div>                
                <div class="radio">
                 <label><input value="Quarterly_{{ $plans->quarterly_price }}_{{ Auth::User()->business->id }}" type="radio" name="payment_plan">Quarterly ${{ $plans->quarterly_price }}</label>
                </div>                
                <div class="radio">
                 <label><input value="Monthly_{{ $plans->monthly_price }}_{{ Auth::User()->business->id }}" type="radio" name="payment_plan">Monthly ${{ $plans->monthly_price }}</label>
                </div>
                </div>               
                                                                                                                        
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                   <button id="submit-payment-form-btn" type="submit" class="btn btn-primary">Make Payment</button>
                </div>
             </form>            
      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->
@endsection

