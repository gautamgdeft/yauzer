@extends('layouts.admin')
@section('content')



<aside class="right-side">
 <!-- Content Header (Page header) -->
 <section class="content-header">
  <h1> FAQ Management </h1>
  <ol class="breadcrumb">
   <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">FAQ Management</li>
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
     <a href="{{ route('admin.show_faq_form') }}" class="btn bg-olive btn-flat">Add New FAQ</a>
   </div>
   <!-- /.box-header -->

  {{-- All Pages Result Display --}}
  @if(isset($faqs))
  <div class="box-body table-responsive no-padding">
    <table class="table table-hover table-bordered">
      
       <tr>
        <th>Question</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    
    
      @if(!is_null($faqs))
      @foreach($faqs as $loopingFaqs)
      <tr class="tr_{{ $loopingFaqs->id }}">
        <td>{{ $loopingFaqs->question }}</td>
        <td>

          <button id="active_{{ $loopingFaqs->id }}" class="btn btn-success btn-flat active_faq @if($loopingFaqs->status == '0') hide @endif" data-id="{{ $loopingFaqs->id }}" data-toggle="tooltip" title="Click to Inactive">Active</button>

          <button id="inactive_{{ $loopingFaqs->id }}" class="btn btn-danger btn-flat active_faq @if($loopingFaqs->status == '1') hide @endif" data-id="{{ $loopingFaqs->id }}" data-toggle="tooltip" title="Click to Active">Inactive</button>                                                    
        </td>
        <td>
          <button class="btn btn-danger btn-flat delete_faq" data-id="{{ $loopingFaqs->id }}" data-toggle="tooltip" title="Delete FAQ"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
          <a href="{{ route('admin.edit_faq_form',['slug' => $loopingFaqs->slug ]) }}" class="btn btn-warning btn-flat" data-toggle="tooltip" title="Edit FAQ"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
          <a href="{{ route('admin.view_faq',['slug' => $loopingFaqs->slug]) }}" class="btn btn-info btn-flat" data-toggle="tooltip" title="View FAQ"><i class="fa fa-eye" aria-hidden="true"></i></a>          
        </td>

      </tr>
      @endforeach
      @endif
      
    
    
     <tr>
      <th>Question</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  
</table>
</div>
  <div class="box-footer clearfix">
      <ul class="pagination pagination-sm no-margin pull-right">
          <li>@if($faqs){!! $faqs->render() !!}@endif</li>
      </ul>
  </div>
<!-- /.box-body -->

@endif

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
        //     $('#example1').dataTable( {
        //        'aoColumnDefs': [{
        //             'bSortable': false,
        //             'aTargets': ['no-sort']
        //         }]
        //     });   
        // $('#example1').dataTable({
        //     "bPaginate": true,
        //     "bLengthChange": false,
        //     "bFilter": false,
        //     "bSort": true,
        //     "bInfo": true,
        //     "bAutoWidth": false
        // });


// Deleting-Category
$('.delete_faq').click(function()
{
  var confirmation = confirm("Are you sure you want to delete this Faq?");
  if (confirmation) 
  {    
  	$(this).html('Deleting...');
  	var faq_id = $(this).data('id');
  	$.ajax({
     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},    	
     url: "{{ route('admin.destroy_faq') }}",
     type: "post",
     dataType: "JSON",
     data: { 'id': $(this).data('id') },
     success: function(response)
     {
      if ( response.status === 'success' ) 
      {
       $('.tr_'+faq_id).remove();
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


// Changing Menu Status Active/Inactive
$('.active_faq').click(function()
{
  $(this).html('Please wait..');
  var faq_id = $(this).data('id');

  $.ajax({
   headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},    	
   url: "{{ route('admin.update_faq_status') }}",
   type: "post",
   dataType: "JSON",
   data: { 'id': $(this).data('id') },
   success: function(response)
   {
     if ( response.status === 'success' ) 
     {
       $('#inactive_'+faq_id).addClass('hide');
       $('#inactive_'+faq_id).html('Inactive'); 
       $('#active_'+faq_id).removeClass('hide');         
       $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
       $('.alert-success').delay(5000).fadeOut('fast');
     }else{
       $('#active_'+faq_id).addClass('hide');
       $('#active_'+faq_id).html('Active'); 
       $('#inactive_'+faq_id).removeClass('hide');         
       $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
       $('.alert-success').delay(5000).fadeOut('fast');
     }
   },
   error: function( response ) 
   {
     if ( response.status === 422 ) 
     {
       $(this).html('Try Again');
       $('#msgs').html("<div class='alert alert-error'>"+response.msg+"</div>");
       $('.alert-success').delay(5000).fadeOut('fast');
     }
   }

 });    

});


});    
</script>
@endsection


