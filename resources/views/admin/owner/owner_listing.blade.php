@extends('layouts.admin')

@section('content')



<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Owner Management </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Owner Management</li>
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
               <a href="{{ route('admin.show_owner_form') }}" class="btn bg-olive btn-flat">Add New Owner</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
               <table id="example1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Customer Status</th>
                        <th>Registeration Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                  	 @if(!is_null($allusers))
                  	 @foreach($allusers as $loopingUsers)

                     <tr class="tr_{{ $loopingUsers->id }}">
                        <td>{{ $loopingUsers->name }}</td>
                        <td>{{ $loopingUsers->email }}</td>
                        <td><img id="image_src" class="img-circle" src="/uploads/avatars/{{ $loopingUsers->avatar }}" style="height: 45px; width: 45px;"></td>

                        <td>
 							            <button id="activate_user_{{ $loopingUsers->id }}" class="btn btn-success btn-flat activate_user @if($loopingUsers->login_status == '1') hide @endif" data-id="{{ $loopingUsers->id }}" data-toggle="tooltip" title="Click to Activate Customer">Activate Customer</button>

	                        <button id="inactivate_user_{{ $loopingUsers->id }}" class="btn btn-danger btn-flat activate_user @if($loopingUsers->login_status == '0') hide @endif" data-id="{{ $loopingUsers->id }}" data-toggle="tooltip" title="Click to Inactivate Customer">Inactivate Customer</button>                        	
                        </td>

                        <td>
	                        <button id="accept_reg_{{ $loopingUsers->id }}" class="btn btn-success btn-flat accept_reg @if($loopingUsers->registeration_status == '1') hide @endif" data-id="{{ $loopingUsers->id }}" data-toggle="tooltip" title="Click to Accept Registeration">Accept</button>

	                        <button id="reject_reg_{{ $loopingUsers->id }}" class="btn btn-danger btn-flat accept_reg @if($loopingUsers->registeration_status == '0') hide @endif" data-id="{{ $loopingUsers->id }}" data-toggle="tooltip" title="Click to Reject Registeration">Reject</button>  
                        </td>

                        <td><button class="btn btn-danger btn-flat delete_user" data-id="{{ $loopingUsers->id }}" data-toggle="tooltip" title="Delete Owner"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        <a href="{{ route('admin.edit_owner_form',['slug' => $loopingUsers->slug]) }}" class="btn btn-warning btn-flat" data-toggle="tooltip" title="Edit Owner"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
             			      <a href="{{ route('admin.show_customer',['slug' => $loopingUsers->slug]) }}" class="btn btn-info btn-flat" data-toggle="tooltip" title="View Owner"><i class="fa fa-eye" aria-hidden="true"></i></a>
                       </td>

                     </tr>
                     @endforeach
                     @endif
                     
                  </tbody>
                  <tfoot>
                     <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Customer Status</th>
                        <th>Registeration Status</th>
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


// Deleting-Simple-User
$('.delete_user').click(function()
{
    var confirmation = confirm("Are you sure you want to delete this owner?");
    if (confirmation) 
    {   
  	$(this).html('Deleting...');
  	var user_id = $(this).data('id');
  	$.ajax({
  			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},    	
              url: "{{ route('admin.destoy_owner') }}",
              type: "post",
              dataType: "JSON",
              data: { 'id': $(this).data('id') },
              success: function(response)
              {
              	if ( response.status === 'success' ) 
  				{
  				   $('.tr_'+user_id).remove();
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

// Accepting Registeration Status
$('.accept_reg').click(function()
{
    $(this).html('Please wait..');
    var user_id = $(this).data('id');
	$.ajax({
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},    	
            url: "{{ route('admin.update_owner_registeration_status') }}",
            type: "post",
            dataType: "JSON",
            data: { 'id': $(this).data('id') },
            success: function(response)
            {
            	if ( response.status === 'success' ) 
				{
				   $('#accept_reg_'+user_id).html('Accept');	
				   $('#accept_reg_'+user_id).addClass('hide');
				   $('#reject_reg_'+user_id).removeClass('hide');
				   $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
				}else{
				   $('#reject_reg_'+user_id).html('Reject');	
				   $('#reject_reg_'+user_id).addClass('hide');					
				   $('#accept_reg_'+user_id).removeClass('hide');
				   $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
				}
            }

           });    

});


// Changing Customer Status Activate User/Inacttivate User
$('.activate_user').click(function()
{
    $(this).html('Please wait..');
    var user_id = $(this).data('id');
	$.ajax({
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},    	
            url: "{{ route('admin.update_owner_status') }}",
            type: "post",
            dataType: "JSON",
            data: { 'id': $(this).data('id') },
            success: function(response)
            {
            	if ( response.status === 'success' ) 
				{
				   $('#activate_user_'+user_id).html('Activate Customer');	
				   $('#activate_user_'+user_id).addClass('hide');
				   $('#inactivate_user_'+user_id).removeClass('hide');
				   $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
				}else{
				   $('#inactivate_user_'+user_id).html('Inacttivate Customer');	
				   $('#inactivate_user_'+user_id).addClass('hide');					
				   $('#activate_user_'+user_id).removeClass('hide');
				   $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
				}
            }

           });    

});


    });    
</script>
@endsection


