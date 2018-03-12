@extends('layouts.admin')

@section('content')



<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Business Sub-Category Management </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Business Sub-Category Management</li>
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
               <a href="{{ route('admin.show_subcategory_form',['slug' => $slug]) }}" class="btn bg-olive btn-flat">Add New Sub-Category</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
               <table id="example1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>Category Name</th>
                        <th>Sub-Category Name</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                    @if(!is_null($subcategory))
                    @foreach($subcategory as $loopingSubcategories)
                    <tr class="tr_{{ $loopingSubcategories->id }}">
                     <td>{{ $loopingSubcategories->business_category->name }}</td>
                     <td>{{ $loopingSubcategories->name }}</td>
                     <td><img id="image_src" class="img-circle" src="/uploads/subcategoryAvatars/{{ $loopingSubcategories->avatar }}" style="height: 45px; width: 45px;"></td>
                     <td>

                      <button id="active_{{ $loopingSubcategories->id }}" class="btn btn-success btn-flat active_subcategory @if($loopingSubcategories->status == '0') hide @endif" data-id="{{ $loopingSubcategories->id }}" data-toggle="tooltip" title="Click to Inactive">Active</button>

                      <button id="inactive_{{ $loopingSubcategories->id }}" class="btn btn-danger btn-flat active_subcategory @if($loopingSubcategories->status == '1') hide @endif" data-id="{{ $loopingSubcategories->id }}" data-toggle="tooltip" title="Click to Active">Inactive</button>                                                    
                   </td>
                   <td>
                      <button class="btn btn-danger btn-flat delete_subcategory" data-id="{{ $loopingSubcategories->id }}" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                      <a href="{{ route('admin.edit_subcategory_form',['slug' => $loopingSubcategories->slug]) }}" class="btn btn-warning btn-flat" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                   </td>

                </tr>
                @endforeach
                @endif
                
             </tbody>
             <tfoot>
               <tr>
                  <th>Category Name</th>
                  <th>Sub-Category Name</th>
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
$('.delete_subcategory').click(function()
{
  var confirmation = confirm("Are you sure you want to delete this subcategory?");
  if (confirmation) 
  {   
     $(this).html('Deleting...');
     var subcategory_id = $(this).data('id');
     $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},     
        url: "{{ route('admin.destroy_subcategory') }}",
        type: "post",
        dataType: "JSON",
        data: { 'id': $(this).data('id') },
        success: function(response)
        {
         if ( response.status === 'success' ) 
         {
           $('.tr_'+subcategory_id).remove();
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
$('.active_subcategory').click(function()
{
  $(this).html('Please wait..');
  var subcategory_id = $(this).data('id');

  $.ajax({
   headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},     
   url: "{{ route('admin.update_subcategory_status') }}",
   type: "post",
   dataType: "JSON",
   data: { 'id': $(this).data('id') },
   success: function(response)
   {
      if ( response.status === 'success' ) 
      {
       $('#inactive_'+subcategory_id).addClass('hide');
       $('#inactive_'+subcategory_id).html('Inactive'); 
       $('#active_'+subcategory_id).removeClass('hide');         
       $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
    }else{
       $('#active_'+subcategory_id).addClass('hide');
       $('#active_'+subcategory_id).html('Active'); 
       $('#inactive_'+subcategory_id).removeClass('hide');         
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


