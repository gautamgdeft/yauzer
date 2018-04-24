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
                      <select class="form-control" name="payment_plan">
                        <option value="Annually_5_{{ Auth::User()->business->id }}">Annually $5</option>
                        <option value="Semi-Annually_4_{{ Auth::User()->business->id }}">Semi-Annually $4</option>
                        <option value="Quarterly_3_{{ Auth::User()->business->id }}">Quarterly $3</option>
                        <option value="Monthly_2_{{ Auth::User()->business->id }}">Monthly $2</option>
                      </select>
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

