@extends('layouts.admin')
 
@section('content')

<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Change Password </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Change Password</li>
      </ol>
   </section>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
   <!-- Main content -->
   <section class="content">
      <div class="box box-primary">

            <form method="POST" action="{{ route('admin.changepassword') }}">
                {{ csrf_field() }}

              <div class="box-body">
                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                    <label for="new-password">Current Password</label>

                        <input id="current-password" type="password" class="form-control" name="current-password" required>

                        @if ($errors->has('current-password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('current-password') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                    <label for="new-password">New Password</label>

                        <input id="new-password" type="password" class="form-control" name="new-password" required>

                        @if ($errors->has('new-password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('new-password') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group">
                    <label for="new-password-confirm">Confirm New Password</label>

                        <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                </div>

            <div class="box-footer">
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
               </div> 
            </form>

      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>        

@endsection
 