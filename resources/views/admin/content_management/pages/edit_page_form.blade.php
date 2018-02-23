@extends('layouts.admin')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Edit Page </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Edit Page</li>
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
         <form role="form" action="{{ route('admin.update_page',['slug' => $page->slug]) }}" enctype="multipart/form-data" method="POST">
         	{{ csrf_field() }}
            <div class="box-body">
               <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $page->name }}" required="required">

                  @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif

               </div>               
                                                                                                            

               <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                  <label for="description">Description</label>
                  <textarea class="form-control" name="description" id="description-ckeditor">{{ $page->description }}</textarea>

                  @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                  @endif

               </div>

               <div class="form-group{{ $errors->has('metatitle') ? ' has-error' : '' }}">
                  <label for="metatitle">Metatitle</label>
                  <input type="text" class="form-control" id="metatitle" name="metatitle" value="{{ $page->metatitle }}" required="required">

                  @if ($errors->has('metatitle'))
                    <span class="help-block">
                        <strong>{{ $errors->first('metatitle') }}</strong>
                    </span>
                  @endif

               </div>

               <div class="form-group{{ $errors->has('metakeywords') ? ' has-error' : '' }}">
                  <label for="metakeywords">Metakeywords</label>
                  <input type="text" class="form-control" id="metakeywords" name="metakeywords" value="{{ $page->metakeywords }}" required="required">

                  @if ($errors->has('metakeywords'))
                    <span class="help-block">
                        <strong>{{ $errors->first('metakeywords') }}</strong>
                    </span>
                  @endif

               </div>


               <div class="form-group{{ $errors->has('metadescription') ? ' has-error' : '' }}">
                  <label for="metadescription">Metadescription</label>
                  <input type="text" class="form-control" id="metadescription" name="metadescription" value="{{ $page->metadescription }}" required="required">

                  @if ($errors->has('metadescription'))
                    <span class="help-block">
                        <strong>{{ $errors->first('metadescription') }}</strong>
                    </span>
                  @endif

               </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
               <button type="submit" class="btn btn-primary">Update</button>
               <a href="{{ URL::previous() }}" class="btn btn-primary">Go Back</a>
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
<script type="text/javascript">

CKEDITOR.replace( 'description-ckeditor' );

</script>     

@endsection