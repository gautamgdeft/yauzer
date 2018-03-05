@extends('layouts.admin')

@section('content')

<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Report Management
         
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Report Management</li>
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
                     Customers
                  </p>
               </div>
               <div class="icon">
                  <i class="fa fa-briefcase"></i>
               </div>
               <a href="{{ route('admin.export') }}" class="small-box-footer">
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
                     Owners
                  </p>
               </div>
               <div class="icon">
                  <i class="fa fa-eye"></i>
               </div>
               <a href="#" class="small-box-footer">
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
                     {{ $total_business }}
                  </h3>
                  <p>
                     Business
                  </p>
               </div>
               <div class="icon">
                  <i class="fa fa-signal"></i>
               </div>
               <a href="#" class="small-box-footer">
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
               <a href="#" class="small-box-footer">
               More info <i class="fa fa-arrow-circle-right"></i>
               </a>
            </div>
         </div>
         <!-- ./col -->
      </div>
      <!-- /.row -->

   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->

@endsection
