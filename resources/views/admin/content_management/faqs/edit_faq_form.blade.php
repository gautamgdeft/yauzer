@extends('layouts.admin')
@section('content')


<aside class="right-side">
 <!-- Content Header (Page header) -->
 <section class="content-header">
  <h1> Edit FAQ </h1>
  <ol class="breadcrumb">
   <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Edit FAQ</li>
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
   <form id="edit-faq-form" role="form" action="{{ route('admin.update_faq',['slug' => $faq->slug]) }}" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    <div class="box-body">
     <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
      <label for="question">Menu Name</label>
      <input type="text" class="form-control" id="question" name="question" value="{{ $faq->question }}" required="required">

      @if ($errors->has('question'))
      <span class="help-block">
        <strong>{{ $errors->first('question') }}</strong>
      </span>
      @endif

    </div>               
    

    <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
      <label for="answer">Answer</label>
      <textarea class="form-control" id="answer" name="answer" required="required">{{ $faq->answer }}</textarea>

      @if ($errors->has('answer'))
      <span class="help-block">
        <strong>{{ $errors->first('answer') }}</strong>
      </span>
      @endif

    </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
   <button id="faq-submit-btn" type="submit" class="btn btn-primary">Update</button>
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
<script type="text/javascript">

  $(document).ready(function()
  {
       //Adding-Validations
  $('#edit-faq-form').validate({
  onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
  },

    rules: {
    
      valueToBeTested: {
          required: true,
      }

    },

  });

  $('#faq-submit-btn').click(function()
  {
    if($('#edit-faq-form').valid())
    {
      $('#faq-submit-btn').prop('disabled', true);
      $('#edit-faq-form').submit();
    }else{
      return false;
    }
  });

  });
</script>     

@endsection