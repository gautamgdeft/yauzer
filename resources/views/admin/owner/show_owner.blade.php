@extends('layouts.admin')
@section('content')
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> View User Details </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">View Owner Details</li>
      </ol>
   </section>

   <section class="content">
      <div class="row">
         <div class="col-xs-12">
            <div class="box">
               <div class="users view large-9 medium-8 columns content col-md-7 col-sm-12 col-xs-12">
                  <!-- <h3>113</h3> -->
                  <table class="vertical-table table table-bordered">
                     <tr>
                        <th scope="row">ID</th>
                        <td>{{ $user->id }}</td>
                     </tr>

                     <tr>
                        <th scope="row">Name</th>
                        <td>{{ $user->name }}</td>
                     </tr>

                     <tr>
                        <th scope="row">Email</th>
                        <td>{{ $user->email }}</td>
                     </tr>

                     <tr>
                        <th scope="row">Address</th>
                        <td>{{ $user->address }}</td>
                     </tr>

                     <tr>
                        <th scope="row">City</th>
                        <td>{{ $user->city }}</td>
                     </tr>

                     <tr>
                        <th scope="row">State</th>
                        <td>{{ $user->state }}</td>
                     </tr>                     

                     <tr>
                        <th scope="row">Country</th>
                        <td>{{ $user->country }}</td>
                     </tr>

                     <tr>
                        <th scope="row">Zipcode</th>
                        <td>{{ $user->zipcode }}</td>
                     </tr>

                     <tr>
                        <th scope="row">Owner Status</th>
                        <td>@if($user->login_status == '1')Active Owner @else Inactive Owner @endif</td>
                     </tr>

                     <tr>
                        <th scope="row">Profile Image</th>
                        <td><img id="image_src" class="img-circle" src="/uploads/avatars/{{ $user->avatar }}" style="height: 45px; width: 45px;"></td>
                     </tr>

                  </table>

               </div>
            </div>
            <!-- /.box -->
         </div>
      </div>
   </section>
   </section>
   <!-- /.content -->            
</aside>
@endsection
