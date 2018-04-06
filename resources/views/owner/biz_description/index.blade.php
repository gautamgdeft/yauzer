@extends('layouts.owner')
@section('content')
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Business Description </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Business Description</li>
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
   <h3>Business Description</h3>
   <a href="{{ route('owner.show_business_description_form', ['slug' => $business->slug]) }}" class="btn bg-olive btn-flat">Edit</a>
</div>


@if(@sizeof($business->description))

 <p>{{ $business->description }}</p>

@endif

<p class="dum @if(@sizeof($business->description)) hide @endif">No description found for this business.</p>
            </div>
         </div>
      </div>
   </section>
</aside>
<!-- /.right-side -->
@endsection