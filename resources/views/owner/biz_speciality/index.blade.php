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
               <div class="box-header speciality-1">
                  <h3>Specialties</h3>
                  <a href="{{ route('owner.new_speciality_form', ['slug' => $business->slug]) }}" class="btn bg-olive btn-flat">Add Speciality</a>
               </div>
               @if(@sizeof($businessSpecialitiesInfo))
               <div class="row">
                  <div class="col-sm-12">
                     <ul class="speciality_checks">
                        @foreach($businessSpecialitiesInfo as $loopingSpecialties)
                        <li id="speciality_li_{{ $loopingSpecialties->id }}">
                           <div class="commentbox-content">
                              <p>{{ $loopingSpecialties->name }}</p>
                           </div>
                           <button class="btn btn-danger btn-flat delete_speciality" data-id="{{ $loopingSpecialties->id }}" data-toggle="tooltip" title="" data-original-title="Delete Speciality"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                           <a href="{{ route('owner.edit_speciality',[ 'speciality_slug' => $loopingSpecialties->slug, 'slug' => $business->slug]) }}" class="btn btn-warning btn-flat" data-toggle="tooltip" title="" data-original-title="Edit Speciality"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        </li>
                        @endforeach
                     </ul>
                  </div>
               </div>
               @endif
               <p class="dum @if(@sizeof($businessSpecialitiesInfo)) hide @endif">No speciality found for this business.</p>
            </div>
         </div>
      </div>
   </section>
</aside>
<!-- /.right-side -->
@endsection