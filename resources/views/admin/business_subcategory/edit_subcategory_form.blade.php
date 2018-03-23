@extends('layouts.admin')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Edit Business Sub-Category </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Edit Business Sub-Category</li>
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
         <form id="edit-subcategory-form" role="form" action="{{ route('admin.update_subcategory',['category' => $category ,'slug' => $subcategory->slug]) }}" enctype="multipart/form-data" method="POST">
         	{{ csrf_field() }}
            <div class="box-body">

               <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">Category</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $subcategory->business_category->name }}" required="required" disabled="disabled">

                  @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif

               </div>   

               <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">Sub-Category Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $subcategory->name }}" required="required">

                  @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif

               </div>               
                                                                                                            

               <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                  <label for="avatar">Sub-Category Image</label>
                  <input type="file" id="avatar" name="avatar" class="form-control" onchange="ValidateSingleInput(this);">

                  @if ($errors->has('avatar'))
      			        <span class="help-block">
      			            <strong>{{ $errors->first('avatar') }}</strong>
      			        </span>
		              @endif

                  <img id="image_src" class="img-circle" src="/uploads/subcategoryAvatars/{{ $subcategory->avatar }}" style="height: 45px; width: 45px;">
               </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
               <button id="edit-subcategory-submit-btn" type="submit" class="btn btn-primary">Update</button>
               <a href="{{ URL::previous() }}" class="btn btn-warning">Go Back</a>
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