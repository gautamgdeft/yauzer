@extends('layouts.admin')

@section('content')



<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Business Category Management </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Business Category Management</li>
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
               <a href="{{ route('admin.show_category_form') }}" class="btn bg-olive btn-flat">Add New Category</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
               <table id="example1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                  	 @if(!is_null($business_categories))
                  	 @foreach($business_categories as $loopingCategories)
                     <tr class="tr_{{ $loopingCategories->id }}">
                        <td>{{ $loopingCategories->name }}</td>
                        <td><img id="image_src" class="img-circle" src="/uploads/categoryAvatars/{{ $loopingCategories->avatar }}" style="height: 45px; width: 45px;"></td>
                        <td>

                          <button id="active_{{ $loopingCategories->id }}" class="btn btn-success btn-flat active_category @if($loopingCategories->status == '0') hide @endif" data-id="{{ $loopingCategories->id }}">Active</button>

                          <button id="inactive_{{ $loopingCategories->id }}" class="btn btn-danger btn-flat active_category @if($loopingCategories->status == '1') hide @endif" data-id="{{ $loopingCategories->id }}">Inactive</button>                                                    
                        </td>
                        <td>
                          <button class="btn btn-danger btn-flat delete_category" data-id="{{ $loopingCategories->id }}">Delete</button>
                          <a href="{{ route('admin.edit_category_form',['slug' => $loopingCategories->slug]) }}" class="btn btn-warning btn-flat">Edit</a>
               		      	<a href="{{ route('admin.show_category',['slug' => $loopingCategories->slug]) }}" class="btn btn-info btn-flat">View Category</a>
                       </td>

                     </tr>
                     @endforeach
                     @endif
                     
                  </tbody>
                  <tfoot>
                     <tr>
                        <th>Name</th>
                        <th>Image</th>
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
$('.delete_category').click(function()
{
	$(this).html('Deleting...');
	var category_id = $(this).data('id');
	$.ajax({
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},    	
            url: "{{ route('admin.destroy_category') }}",
            type: "post",
            dataType: "JSON",
            data: { 'id': $(this).data('id') },
            success: function(response)
            {
              if ( response.status === 'success' ) 
      				{
      				   $('.tr_'+category_id).remove();
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


// Changing Category Status Active/Inactive
$('.active_category').click(function()
{
    $(this).html('Please wait..');
    var category_id = $(this).data('id');

	$.ajax({
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},    	
            url: "{{ route('admin.update_category_status') }}",
            type: "post",
            dataType: "JSON",
            data: { 'id': $(this).data('id') },
            success: function(response)
            {
            	if ( response.status === 'success' ) 
      				{
                 $('#inactive_'+category_id).addClass('hide');
                 $('#inactive_'+category_id).html('Active'); 
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


