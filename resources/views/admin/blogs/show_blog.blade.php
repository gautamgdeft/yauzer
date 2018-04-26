@extends('layouts.admin')
@section('content')
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> View Blog Details </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">View Blog Details</li>
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
                        <td>{{ $blog->id }}</td>
                     </tr>

                     <tr>
                        <th scope="row">Category</th>
                        <td>{{ $blog->blogcategory->name }}</td>
                     </tr>                      

                     <tr>
                        <th scope="row">Title</th>
                        <td>{{ $blog->title }}</td>
                     </tr>                     

                     <tr>
                        <th scope="row">Meta-Title</th>
                        <td>{{ $blog->metatitle }}</td>
                     </tr>                      

                     <tr>
                        <th scope="row">Meta-Keywords</th>
                        <td>{{ $blog->metakeywords }}</td>
                     </tr>                      

                     <tr>
                        <th scope="row">Meta-Description</th>
                        <td>{{ $blog->metadescription }}</td>
                     </tr>                     

                     <tr>
                        <th scope="row">Blog Image</th>
                        <td><img id="image_src" class="img-circle" src="/uploads/blogavatars/{{ $blog->avatar }}" style="height: 45px; width: 45px;"></td>
                     </tr>                  

                     <tr>
                        <th scope="row">Date Created</th>
                        <td>{{ $blog->created_at->format('m-d-Y') }}</td>
                     </tr>

                     <tr>
                        <th scope="row">Status</th>
                        <td>@if($blog->status == '1')Active @else Inactive @endif</td>
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
