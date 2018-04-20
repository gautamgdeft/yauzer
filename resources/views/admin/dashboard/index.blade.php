@extends('layouts.admin')

@section('content')

<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Dashboard
         <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Dashboard</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
         <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
               <div class="inner">
                  <h3>
                     {{ $total_customers }}
                  </h3>
                  <p>
                     Users
                  </p>
               </div>
               <div class="icon">
                  <i class="fa fa-briefcase"></i>
               </div>
               <a href="{{ route('admin.customer_export') }}" class="small-box-footer">
               More info <i class="fa fa-arrow-circle-right"></i>
               </a>
            </div>
         </div>
         <!-- ./col -->

         <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
               <div class="inner">
                  <h3>
                     {{ $total_owners }}
                  </h3>
                  <p>
                     Business Owners
                  </p>
               </div>
               <div class="icon">
                  <i class="fa fa-eye"></i>
               </div>
               <a href="{{ route('admin.owner_export') }}" class="small-box-footer">
               More info <i class="fa fa-arrow-circle-right"></i>
               </a>
            </div>
         </div>
         <!-- ./col -->

         <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
               <div class="inner">
                  <h3>
                     {{ $total_basic_business }}
                  </h3>
                  <p>
                     Basic Businesses
                  </p>
               </div>
               <div class="icon">
                  <i class="fa fa-signal"></i>
               </div>
               <a href="{{ route('admin.basic_business_export') }}" class="small-box-footer">
               More info <i class="fa fa-arrow-circle-right"></i>
               </a>
            </div>
         </div>
         <!-- ./col -->         

         <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
               <div class="inner">
                  <h3>
                     {{ $total_premium_business }}
                  </h3>
                  <p>
                     Premium Businesses
                  </p>
               </div>
               <div class="icon">
                  <i class="fa fa-signal"></i>
               </div>
               <a href="{{ route('admin.premium_business_export') }}" class="small-box-footer">
               More info <i class="fa fa-arrow-circle-right"></i>
               </a>
            </div>
         </div>
         <!-- ./col -->

         <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
               <div class="inner">
                  <h3>
                     {{ $total_yauzers }}
                  </h3>
                  <p>
                     Yauzers
                  </p>
               </div>
               <div class="icon">
                  <i class="fa fa-user"></i>
               </div>
               <a href="{{ route('admin.yauzer_export') }}" class="small-box-footer">
               More info <i class="fa fa-arrow-circle-right"></i>
               </a>
            </div>
         </div>
         <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- top row -->
      <div class="row">
         <div class="col-xs-12 connectedSortable">
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->

   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->

@endsection
