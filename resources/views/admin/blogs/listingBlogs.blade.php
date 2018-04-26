@extends('layouts.admin')

@section('content')



<aside class="right-side">
 <!-- Content Header (Page header) -->
 <section class="content-header">
  <h1> Manage Blogs </h1>
  <ol class="breadcrumb">
   <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Manage Blogs</li>
 </ol>
</section>

<div id="msgs">
 @if(session('success'))
 <div class="alert alert-success">
  {{ session('success') }}
</div>
@endif
</div>

<section class="content">
 <div class="row">
  <div class="col-xs-12">
   <div class="box">
    <div class="box-header">
    <a href="{{ route('admin.show_blog_form') }}" class="btn bg-olive btn-flat">Add New Blog</a>
    <a href="{{ route('admin.show_blog_category_form') }}" class="btn bg-olive btn-flat">Add New Category</a>

    <div class="box-tools src-filter">
        <form action="{{ route('blogMain.search') }}" method="POST" role="search">
          {{ csrf_field() }}
          <div class="input-group">
              <input type="text" name="search_parameter" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" value="@if(isset($details)) {{ $query }} @endif"/>
              <div class="input-group-btn">
                  <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
              </div>
          </div>
        </form>

        @if(isset($details))
          <a href="{{ route('admin.listingBlogs') }}" class="btn btn-danger btn-flat search-filter">Clear Filter</a>
        @endif   

    </div>      
   </div>    
     <!-- /.box-header -->

    {{-- All Contacts Result Display --}}
    @if(isset($blogs))
    <div class="box-body table-responsive no-padding">
      <table class="table table-hover table-bordered">
        
         <tr>
          <th>Title</th>
          <th>Date Created</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      
      
        @if(!is_null($blogs))
        @foreach($blogs as $loopingblogs)
        <tr class="tr_{{ $loopingblogs->id }}">
          <td>{{ $loopingblogs->title }}</td>
          <td>{{ $loopingblogs->created_at->format('m-d-Y')  }}</td>
          <td>

            <button id="active_{{ $loopingblogs->id }}" class="btn btn-success btn-flat active_category @if($loopingblogs->status == '0') hide @endif" data-id="{{ $loopingblogs->id }}" data-toggle="tooltip" title="Click to Inactive">Active</button>

            <button id="inactive_{{ $loopingblogs->id }}" class="btn btn-danger btn-flat active_category @if($loopingblogs->status == '1') hide @endif" data-id="{{ $loopingblogs->id }}" data-toggle="tooltip" title="Click to Active">Inactive</button>                                                    
          </td>
          <td>
            <button class="btn btn-danger btn-flat delete_blog" data-id="{{ $loopingblogs->id }}" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
            <a href="{{ route('admin.edit_blog_form',['slug' => $loopingblogs->slug]) }}" class="btn btn-warning btn-flat" data-toggle="tooltip" title="" data-original-title="Edit Blog"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>            
            <a href="{{ route('admin.show_blog', ['slug' => $loopingblogs->slug]) }}" class="btn btn-info btn-flat" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
          </td>

        </tr>
        @endforeach
        @endif

  </table>
</div>

<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <li>@if($blogs){!! $blogs->render() !!}@endif</li>
    </ul>
</div>

@endif     


    {{-- Searching Result Contacts Display --}}
    @if(isset($details) && !isset($filter))
    <div class="box-body table-responsive no-padding">
      <p> The Search results for your query <b class="cstm-bold"> {{ $query }} </b> are :</p>
      <table class="table table-hover table-bordered">
        
         <tr>
          <th>Name</th>
          <th>Date Created</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      
      
        @if(!is_null($details))
        @foreach($details as $loopingblogs)
        <tr class="tr_{{ $loopingblogs->id }}">
          <td>{{ $loopingblogs->title }}</td>
          <td>{{ $loopingblogs->created_at->format('m-d-Y')  }}</td>
          <td>

            <button id="active_{{ $loopingblogs->id }}" class="btn btn-success btn-flat active_category @if($loopingblogs->status == '0') hide @endif" data-id="{{ $loopingblogs->id }}" data-toggle="tooltip" title="Click to Inactive">Active</button>

            <button id="inactive_{{ $loopingblogs->id }}" class="btn btn-danger btn-flat active_category @if($loopingblogs->status == '1') hide @endif" data-id="{{ $loopingblogs->id }}" data-toggle="tooltip" title="Click to Active">Inactive</button>                                                    
          </td>
          <td>
            <button class="btn btn-danger btn-flat delete_blog" data-id="{{ $loopingblogs->id }}" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
            <a href="{{ route('admin.edit_blog_form',['slug' => $loopingblogs->slug]) }}" class="btn btn-warning btn-flat" data-toggle="tooltip" title="" data-original-title="Edit Blog"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>            
            <a href="{{ route('admin.show_blog', ['slug' => $loopingblogs->slug]) }}" class="btn btn-info btn-flat" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
          </td>

        </tr>
        @endforeach
        @endif
   
  </table>
</div>

<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <li>@if($details){!! $details->render() !!}@endif</li>
    </ul>
</div>

@elseif(isset($message))
<p>{{ $message }}</p>
@endif   

<!-- /.box-body -->
</div>
<!-- /.box -->
</div>
</div>
</section>
<!-- /.content -->            


</aside>
@endsection

@section('custom_scripts')

<!-- page script -->
<script type="text/javascript">
  $(document).ready(function(){

// Deleting-Contact
$(".delete_blog").on("click", function() 
{    
  var confirmation = confirm("Are you sure you want to delete this?");
  if (confirmation) 
  {    
  	$(this).html('Deleting...');
  	var blog_id = $(this).data('id');
  	$.ajax({
     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},    	
     url: "{{ route('admin.destroy_blog') }}",
     type: "post",
     dataType: "JSON",
     data: { 'id': $(this).data('id') },
     success: function(response)
     {
      if ( response.status === 'success' ) 
      {
       $('.tr_'+blog_id).remove();
       $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
     }
   },
   error: function( response ) 
   {
     if ( response.status === 422 ) 
     {
       $(this).html('Delete');
       $('#msgs').html("<div class='alert alert-error'>"+response.msg+"</div>");
     }
   }


  });
  }

});


// Changing Category Status Active/Inactive
$('.active_category').click(function()
{
  $(this).html('Please wait..');
  var category_id = $(this).data('id');

  $.ajax({
   headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},      
   url: "{{ route('admin.update_blog_status') }}",
   type: "post",
   dataType: "JSON",
   data: { 'id': $(this).data('id') },
   success: function(response)
   {
     if ( response.status === 'success' ) 
     {
       $('#inactive_'+category_id).addClass('hide');
       $('#inactive_'+category_id).html('Inactive'); 
       $('#active_'+category_id).removeClass('hide');         
       $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
     }else{
       $('#active_'+category_id).addClass('hide');
       $('#active_'+category_id).html('Active'); 
       $('#inactive_'+category_id).removeClass('hide');         
       $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
     }
   },
   error: function( response ) 
   {
     if ( response.status === 422 ) 
     {
       $(this).html('Try Again');
       $('#msgs').html("<div class='alert alert-error'>"+response.msg+"</div>");
     }
   }

 });    

});

});    
</script>
@endsection


