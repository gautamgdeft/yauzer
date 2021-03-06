@extends('layouts.admin')
@section('content')


<aside class="right-side">
 <!-- Content Header (Page header) -->
 <section class="content-header">
  <h1> Add New Sub-Category </h1>
  <ol class="breadcrumb">
   <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Add New Sub-Category</li>
 </ol>
</section>

@if(session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<!-- Main content -->
<section class="content">
  <div class="box box-primary">
   <!-- form start -->
   <form id="subcategory-form" role="form" action="{{ route('admin.store_subcategory',['slug' => $slug]) }}" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    <div class="box-body">

     <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      <label for="business_category_id">Category Name</label>
      <select class="form-control" name="business_category_id" required="required">
       <option value="{{ $category->id }}">{{ $category->name }}</option>
     </select>  

     @if ($errors->has('business_category_id'))
     <span class="help-block">
      <strong>{{ $errors->first('business_category_id') }}</strong>
    </span>
    @endif

  </div>

  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name">Sub-Category Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required="required">

    @if ($errors->has('name'))
    <span class="help-block">
      <strong>{{ $errors->first('name') }}</strong>
    </span>
    @endif

  </div>

  <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
    <label for="avatar">Sub-Category Image</label>
    <input type="file" id="avatar" name="avatar" class="form-control" onchange="ValidateSingleInput(this);" required="required" >

    @if ($errors->has('avatar'))
    <span class="help-block">
      <strong>{{ $errors->first('avatar') }}</strong>
    </span>
    @endif

    <img id="image_src" class="img-circle" src="/uploads/categoryAvatars/default.png" style="height: 45px; width: 45px;">
  </div>                              

</div>
<!-- /.box-body -->
<div class="box-footer">
 <button id="subcategory-submit-btn" type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
</div>
<!-- /.box -->
</section>
<!-- /.content -->
</aside>
<!-- /.right-side -->
@endsection




@section('custom_scripts') 
<script src="{{ asset('js/admin/categories.js') }}"></script>
@endsection