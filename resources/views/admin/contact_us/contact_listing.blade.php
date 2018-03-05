@extends('layouts.admin')

@section('content')



<aside class="right-side">
 <!-- Content Header (Page header) -->
 <section class="content-header">
  <h1> Contact Us Listing </h1>
  <ol class="breadcrumb">
   <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Contact Us Listing</li>
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
     <!-- /.box-header -->
     <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
        <thead>
         <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Message</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @if(!is_null($contact_listing))
        @foreach($contact_listing as $loopingcontacts)
        <tr class="tr_{{ $loopingcontacts->id }}">
          <td>{{ $loopingcontacts->name }}</td>
          <td>{{ $loopingcontacts->email }}</td>
          <td>{{ $loopingcontacts->message }}</td>
          <td>
            <button class="btn btn-danger btn-flat delete_contact" data-id="{{ $loopingcontacts->id }}" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
            <a href="" class="btn btn-info btn-flat" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>            
          </td>

        </tr>
        @endforeach
        @endif

      </tbody>
      <tfoot>
       <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
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


// Deleting-Contact
$('.delete_contact').click(function()
{
	$(this).html('Deleting...');
	var contact_id = $(this).data('id');
	$.ajax({
   headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},    	
   url: "{{ route('admin.destroy_contact') }}",
   type: "post",
   dataType: "JSON",
   data: { 'id': $(this).data('id') },
   success: function(response)
   {
    if ( response.status === 'success' ) 
    {
     $('.tr_'+contact_id).remove();
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

});    
</script>
@endsection


