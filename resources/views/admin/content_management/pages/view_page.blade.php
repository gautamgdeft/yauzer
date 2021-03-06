@extends('layouts.admin')
@section('content')
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> View Page Details </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">View Page Details</li>
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
                        <td>{{ $page->id }}</td>
                     </tr>

                     <tr>
                        <th scope="row">Name</th>
                        <td>{{ $page->name }}</td>
                     </tr>                     

                     <tr>
                        <th scope="row">URL</th>
                        <td>{{ $page->pageurl }}</td>
                     </tr>                     

                     <tr>
                        <th scope="row">Meta Title</th>
                        <td>{{ $page->metatitle }}</td>
                     </tr>                     

                     <tr>
                        <th scope="row">Meta Keywords</th>
                        <td>{{ $page->metakeywords }}</td>
                     </tr>                     

                     <tr>
                        <th scope="row">Meta Description</th>
                        <td>{{ $page->metadescription }}</td>
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
