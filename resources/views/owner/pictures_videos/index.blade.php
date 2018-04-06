@extends('layouts.owner')
@section('content')
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Pictures & Videos </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Pictures & Videos</li>
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
               <div class="box-header">
                  <h3>Pictures & Videos</h3>
                  <a href="{{ route('owner.new_picture_form', ['slug' => Auth::user()->business->slug]) }}" class="btn bg-olive btn-flat">Add New Picture</a>
               </div>
               @if(@sizeof($businessPictures))
               @foreach($businessPictures as $loopingPictures)
               <div class="col-xs-12 col-sm-6 col-md-3 img_{{ $loopingPictures->id }}">
                  <div class="thumbnail-pic">
                     <div class="thumbnail">
                        <img id="image_src" src="{{ asset('/uploads/businessAvatars/'.$loopingPictures->avatar) }}">
                     </div>
                     <div class="caption">
                        <a href="javascript:void(0);" class="btn btn-danger delete_picture" data-id="{{ $loopingPictures->id }}"><i class="fa fa-trash-o"></i> </a>
                     </div>
                  </div>
               </div>
               @endforeach
               @endif
               <p class="dum @if(@sizeof($businessPictures)) hide @endif">No pictures found for this business.</p>
            </div>
         </div>
      </div>
   </section>
</aside>
<!-- /.right-side -->
@endsection