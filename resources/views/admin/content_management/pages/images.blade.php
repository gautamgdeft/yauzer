@extends('layouts.admin')

@section('content')



<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Manage Site Images </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Manage Site Images</li>
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
               <a href="{{ route('admin.show_page_form') }}" class="btn bg-olive btn-flat">Add New Image</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
               <table id="example1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>Name</th>
                        <th>Url</th>
                        <th>Metatitle</th>
                        <th>Metakeywords</th>
                        <th>Metadescription</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
{{--                   	 @if(!is_null($pages))
                  	 @foreach($pages as $loopingpages) --}}
                     <tr class="tr_">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                          Active
{{--                           <button id="active_{{ $loopingpages->id }}" class="btn btn-success btn-flat active_page @if($loopingpages->status == '0') hide @endif" data-id="{{ $loopingpages->id }}">Active</button>

                          <button id="inactive_{{ $loopingpages->id }}" class="btn btn-danger btn-flat active_page @if($loopingpages->status == '1') hide @endif" data-id="{{ $loopingpages->id }}">Inactive</button>         --}}                      
                        </td>
                        <td>
                          <button class="btn btn-danger btn-flat delete_page" data-id="}">Delete</button>
                          <a href="" class="btn btn-warning btn-flat">Edit</a>               		      	
                       </td>

                     </tr>
                     {{-- @endforeach
                     @endif --}}
                     
                  </tbody>
                  <tfoot>
                     <tr>
                        <th>Name</th>
                        <th>Url</th>
                        <th>Metatitle</th>
                        <th>Metakeywords</th>
                        <th>Metadescription</th>
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
$('.delete_page').click(function()
{
	$(this).html('Deleting...');
	var page_id = $(this).data('id');
	$.ajax({
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},    	
            url: "{{ route('admin.destroy_page') }}",
            type: "post",
            dataType: "JSON",
            data: { 'id': $(this).data('id') },
            success: function(response)
            {
              if ( response.status === 'success' ) 
      				{
      				   $('.tr_'+page_id).remove();
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


// Changing Page Status Active/Inactive
$('.active_page').click(function()
{
    $(this).html('Please wait..');
    var page_id = $(this).data('id');

  $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},     
            url: "{{ route('admin.update_page_status') }}",
            type: "post",
            dataType: "JSON",
            data: { 'id': $(this).data('id') },
            success: function(response)
            {
              if ( response.status === 'success' ) 
              {
                 $('#inactive_'+page_id).addClass('hide');
                 $('#inactive_'+page_id).html('Active'); 
                 $('#active_'+page_id).removeClass('hide');         
                 $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
              }else{
                 $('#active_'+page_id).addClass('hide');
                 $('#active_'+page_id).html('Active'); 
                 $('#inactive_'+page_id).removeClass('hide');         
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



