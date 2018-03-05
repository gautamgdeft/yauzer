@extends('layouts.admin')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Add New FAQ </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Add New FAQ</li>
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
         <form role="form" action="{{ route('admin.store_faq') }}" enctype="multipart/form-data" method="POST">
         	{{ csrf_field() }}
            <div class="box-body">
               <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                  <label for="question">FAQ Question</label>
                  <input type="text" class="form-control" id="question" name="question" value="{{ old('question') }}" required="required">

                  @if ($errors->has('question'))
                    <span class="help-block">
                        <strong>{{ $errors->first('question') }}</strong>
                    </span>
                  @endif

               </div>
                            
               <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                  <label for="answer">FAQ Answer</label>
                  <textarea class="form-control" id="answer" name="answer" required="required">{{ old('answer') }}</textarea>

                  @if ($errors->has('answer'))
                    <span class="help-block">
                        <strong>{{ $errors->first('answer') }}</strong>
                    </span>
                  @endif

               </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
         </form>
      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->
@endsection