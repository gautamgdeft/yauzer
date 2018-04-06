@extends('layouts.owner')
@section('content')
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Business Hours </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Business Hours</li>
      </ol>
   </section>

   <div id="msgs">
      @if(session('success'))
      <div class="alert alert-success">
         {{ session('success') }}
      </div>
      @endif
   </div>

   <section class="content">
      <div class="box">
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="option-store x_panel">
      <div class="box-header description-1">
         <h3>Business Hours</h3>
      </div>


                 @if(empty ( $businessHours->id ))
                   @include('owner/biz_hours/partials/show_business_hours')         
                 @else
                   @include('owner/biz_hours/partials/updated_business_hours')
                 @endif
            </div>
         </div>
      </div>
   </section>
</aside>
<!-- /.right-side -->
@endsection

