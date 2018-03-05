@extends('layouts.admin')

@section('content')



<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Manage Slider Images </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Manage Slider Images</li>
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
               <a href="{{ route('admin.new_slider_image') }}" class="btn bg-olive btn-flat">Add Slider Image</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
               <table id="example1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                  	 @if(!is_null($sliderImages))
                  	 @foreach($sliderImages as $loopingSliderImages)
                     <tr class="tr_{{ $loopingSliderImages->id }}">
                        <td><img id="image_src" class="" src="/uploads/sliderAvatars/{{ $loopingSliderImages->avatar }}" style="height: 45px; width: 150px;"></td>
                        <td>{{ $loopingSliderImages->description }}</td>
                        <td>
                          <button id="active_{{ $loopingSliderImages->id }}" class="btn btn-success btn-flat active_slide_image @if($loopingSliderImages->status == '0') hide @endif" data-id="{{ $loopingSliderImages->id }}" data-toggle="tooltip" title="Click to Inactive">Active</button>

                          <button id="inactive_{{ $loopingSliderImages->id }}" class="btn btn-danger btn-flat active_slide_image @if($loopingSliderImages->status == '1') hide @endif" data-id="{{ $loopingSliderImages->id }}" data-toggle="tooltip" title="Click to Active">Inactive</button>                              
                        </td>
                        <td>
                          <button class="btn btn-danger btn-flat delete_slider_image" data-id="{{ $loopingSliderImages->id }}" data-toggle="tooltip" title="Delete Slider-image"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                          <a href="{{ route('admin.edit_slider_image',['slug' => $loopingSliderImages->slug]) }}" class="btn btn-warning btn-flat" data-toggle="tooltip" title="Edit Slider-image"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>               		      	
                       </td>

                     </tr>
                     @endforeach
                     @endif
                     
                  </tbody>
                  <tfoot>
                     <tr>
                        <th>Image</th>
                        <th>Description</th>
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
$('.delete_slider_image').click(function()
{
	$(this).html('Deleting...');
	var image_id = $(this).data('id');
	$.ajax({
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},    	
            url: "{{ route('admin.destroy_slider_image') }}",
            type: "post",
            dataType: "JSON",
            data: { 'id': $(this).data('id') },
            success: function(response)
            {
              if ( response.status === 'success' ) 
      				{
      				   $('.tr_'+image_id).remove();
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
$('.active_slide_image').click(function()
{
    $(this).html('Please wait..');
    var image_id = $(this).data('id');

  $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},     
            url: "{{ route('admin.update_slider_image_status') }}",
            type: "post",
            dataType: "JSON",
            data: { 'id': $(this).data('id') },
            success: function(response)
            {
              if ( response.status === 'success' ) 
              {
                 $('#inactive_'+image_id).addClass('hide');
                 $('#inactive_'+image_id).html('Active'); 
                 $('#active_'+image_id).removeClass('hide');         
                 $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
              }else{
                 $('#active_'+image_id).addClass('hide');
                 $('#active_'+image_id).html('Active'); 
                 $('#inactive_'+image_id).removeClass('hide');         
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



