@extends('layouts.admin')
@section('content')
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> View Seo Details </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">View Seo Details</li>
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
                        <td>{{ $siteseo->id }}</td>
                     </tr>                  

                     <tr>
                        <th scope="row">Meta-Title</th>
                        <td>{{ $siteseo->metatitle }}</td>
                     </tr>                      

                     <tr>
                        <th scope="row">Meta-Keywords</th>
                        <td>{{ $siteseo->metakeywords }}</td>
                     </tr>                      

                     <tr>
                        <th scope="row">Meta-Description</th>
                        <td>{{ $siteseo->metadescription }}</td>
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
