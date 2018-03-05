@extends('layouts.admin')

@section('content')



<aside class="right-side">
 <!-- Content Header (Page header) -->
 <section class="content-header">
  <h1> Header Menu Management </h1>
  <ol class="breadcrumb">
   <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Header Menu Management</li>
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
     <a href="{{ route('admin.show_header_menu_form') }}" class="btn bg-olive btn-flat">Add New Header Menu</a>
   </div>
   <!-- /.box-header -->
   <div class="box-body table-responsive">
     <table id="example1" class="table table-bordered table-striped">
      <thead>
       <tr>
        <th>Name</th>
        <th>Url</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @if(!is_null($headerMenus))
      @foreach($headerMenus as $loopingMenus)
      <tr class="tr_{{ $loopingMenus->id }}">
        <td>{{ $loopingMenus->name }}</td>
        <td>{{ $loopingMenus->url }}</td>
        <td>
          <button id="active_{{ $loopingMenus->id }}" class="btn btn-success btn-flat active_menu @if($loopingMenus->status == '0') hide @endif" data-id="{{ $loopingMenus->id }}" data-toggle="tooltip" title="Click to Inactive">Active</button>

          <button id="inactive_{{ $loopingMenus->id }}" class="btn btn-danger btn-flat active_menu @if($loopingMenus->status == '1') hide @endif" data-id="{{ $loopingMenus->id }}" data-toggle="tooltip" title="Click to Active">Inactive</button>                                                    
        </td>
        <td>
          <button class="btn btn-danger btn-flat delete_menu" data-id="{{ $loopingMenus->id }}" data-toggle="tooltip" title="Delete Menu"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
          <a href="{{ route('admin.edit_header_menu', ['slug' => $loopingMenus->slug]) }}" class="btn btn-warning btn-flat" data-toggle="tooltip" title="Edit Menu"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
        </td>

      </tr>
      @endforeach
      @endif
      
    </tbody>
    <tfoot>
     <tr>
      <th>Name</th>
      <th>Url</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </tfoot>
</table>
</div>
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
    $("#example1").dataTable();
        // $('#example1').dataTable({
        //     "bPaginate": true,
        //     "bLengthChange": false,
        //     "bFilter": false,
        //     "bSort": true,
        //     "bInfo": true,
        //     "bAutoWidth": false
        // });


// Deleting-Category
$('.delete_menu').click(function()
{
	$(this).html('Deleting...');
	var menu_id = $(this).data('id');
	$.ajax({
   headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},    	
   url: "{{ route('admin.destroy_header_menu') }}",
   type: "post",
   dataType: "JSON",
   data: { 'id': $(this).data('id') },
   success: function(response)
   {
    if ( response.status === 'success' ) 
    {
     $('.tr_'+menu_id).remove();
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

});


// Changing Menu Status Active/Inactive
$('.active_menu').click(function()
{
  $(this).html('Please wait..');
  var menu_id = $(this).data('id');

  $.ajax({
   headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},    	
   url: "{{ route('admin.update_header_menu_status') }}",
   type: "post",
   dataType: "JSON",
   data: { 'id': $(this).data('id') },
   success: function(response)
   {
     if ( response.status === 'success' ) 
     {
       $('#inactive_'+menu_id).addClass('hide');
       $('#inactive_'+menu_id).html('Inactive'); 
       $('#active_'+menu_id).removeClass('hide');         
       $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
     }else{
       $('#active_'+menu_id).addClass('hide');
       $('#active_'+menu_id).html('Active'); 
       $('#inactive_'+menu_id).removeClass('hide');         
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


