@extends('layouts.owner')

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

    <div id="msgs">
     @if(session('success'))
     <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    </div>
             
   <!-- Main content -->
   <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">

         <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
               <div class="inner">
                  <h3>
                     @if(sizeof(Auth::user()->businesses)) {{ Auth::user()->businesses->count() }} @else 0 @endif
                  </h3>
                  <p>
                     Business
                  </p>
               </div>
               <div class="icon">
                  <i class="fa fa-signal"></i>
               </div>
               <a href="javascript:;" class="small-box-footer">
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
                     @if(sizeof($yauzers['yauzers'])) {{ $yauzers['yauzers']->count() }} @else 0 @endif
                  </h3>
                  <p>
                     Yauzers
                  </p>
               </div>
               <div class="icon">
                  <i class="fa fa-user"></i>
               </div>
               <a href="javascript:;" class="small-box-footer">
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
