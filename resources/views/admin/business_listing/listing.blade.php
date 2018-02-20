@extends('layouts.admin')

@section('content')



<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Business Listing Management </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Business Listing Management</li>
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
{{--             <div class="box-header">
               <a href="{{ route('admin.show_category_form') }}" class="btn bg-olive btn-flat">Add New Category</a>
            </div> --}}
            <!-- /.box-header -->
            <div class="box-body table-responsive">
               <table id="example1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>Name</th>
                        <th>Business Owner</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                  	 @if(!is_null($business_listing))
                  	 @foreach($business_listing as $loopinglistings)
                     <tr class="tr_{{ $loopinglistings->id }}">
                        <td>{{ $loopinglistings->name }}</td>
                        <td>{{ $loopinglistings->user->name }}</td>
                        <td>{{ $loopinglistings->email }}</td>
                        <td><img id="image_src" class="img-circle" src="/uploads/businessAvatars/{{ $loopinglistings->avatar }}" style="height: 45px; width: 45px;"></td>
                        <td>
                          <button id="approve_business_{{ $loopinglistings->id }}" class="btn btn-success btn-flat approve_business @if($loopinglistings->status == '1') hide @endif" data-id="{{ $loopinglistings->id }}">Approve Business</button>

                          <button id="reject_business_{{ $loopinglistings->id }}" class="btn btn-danger btn-flat approve_business @if($loopinglistings->status == '0') hide @endif" data-id="{{ $loopinglistings->id }}">Reject Business</button>                               
                        </td>
                        <td>
                          <button class="btn btn-danger btn-flat delete_business" data-id="{{ $loopinglistings->id }}">Delete</button>
                          <a href="" class="btn btn-warning btn-flat">Edit</a>
               		      	<a href="{{ route('admin.show_business',['slug' => $loopinglistings->slug]) }}" class="btn btn-info btn-flat">View Business</a>
                       </td>

                     </tr>
                     @endforeach
                     @endif
                     
                  </tbody>
                  <tfoot>
                     <tr>
                        <th>Name</th>
                        <th>Business Owner</th>
                        <th>Email</th>
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
$('.delete_business').click(function()
{
	$(this).html('Deleting...');
	var business_id = $(this).data('id');
	$.ajax({
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},    	
            url: "{{ route('admin.destroy_business') }}",
            type: "post",
            dataType: "JSON",
            data: { 'id': $(this).data('id') },
            success: function(response)
            {
              if ( response.status === 'success' ) 
      				{
      				   $('.tr_'+business_id).remove();
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


// Changing Business Status Accept/Reject Business
$('.approve_business').click(function()
{
    $(this).html('Please wait..');
    var business_id = $(this).data('id');

  $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},     
            url: "{{ route('admin.update_business_status') }}",
            type: "post",
            dataType: "JSON",
            data: { 'id': $(this).data('id') },
            success: function(response)
            {
              if ( response.status === 'success' ) 
                {
                   $('#approve_business_'+business_id).html('Approve Business');  
                   $('#approve_business_'+business_id).addClass('hide');
                   $('#reject_business_'+business_id).removeClass('hide');
                   $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
                }else{
                   $('#reject_business_'+business_id).html('Reject Business'); 
                   $('#reject_business_'+business_id).addClass('hide');         
                   $('#approve_business_'+business_id).removeClass('hide');
                   $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
                }
            }

        });    

});



    });    
</script>
@endsection


