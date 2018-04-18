@extends('layouts.owner')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Biz Basic Information  </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Biz Basic Information</li>
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
             <form id="edit-business-form" role="form" action="" enctype="multipart/form-data" method="POST">
              {{ csrf_field() }}
                <div class="box-body">
   
                <div class="form-group">
                      <label for="name">Select Plan</label>
                      <select class="form-control" name="payment_plan">
                        <option>Anually</option>
                        <option>Bi-Anually</option>
                      </select>
                </div>               
                                                                                                                        
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                   <button id="submit-business-form-btn" type="submit" class="btn btn-primary">Update</button>
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

