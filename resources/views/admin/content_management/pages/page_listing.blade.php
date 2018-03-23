@extends('layouts.admin')

@section('content')



<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Manage Pages </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Manage Pages</li>
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
                <a href="{{ route('admin.show_page_form') }}" class="btn bg-olive btn-flat">Add New Page</a>


            <div class="box-tools">
                <form action="{{ route('page.search') }}" method="POST" role="search">
                  {{ csrf_field() }}
                  <div class="input-group">
                      <input type="text" name="search_parameter" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" value="@if(isset($details)) {{ $query }} @endif"/>
                      <div class="input-group-btn">
                          <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                  </div>
                </form>

              @if(isset($details))
                <a href="{{ route('admin.pages') }}" class="btn btn-danger btn-flat search-filter">Clear Filter</a>
              @endif   

            </div>                  
            </div>
            <!-- /.box-header -->

            {{-- All Pages Result Display --}}
            @if(isset($pages))
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-bordered">
                  
                     <tr>
                        <th>Name</th>
                        <th>Url</th>
                        <th>Meta Title</th>
                        <th>Meta Keywords</th>
                        <th>Meta Description</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  
                  
                     @if(!is_null($pages))
                     @foreach($pages as $loopingpages)
                     <tr class="tr_{{ $loopingpages->id }}">
                        <td>{{ $loopingpages->name }}</td>
                        <td>{{ $loopingpages->pageurl }}</td>
                        <td>{{ $loopingpages->metatitle }}</td>
                        <td>{{ $loopingpages->metakeywords }}</td>
                        <td>{{ $loopingpages->metadescription }}</td>
                        <td>
                          <button id="active_{{ $loopingpages->id }}" class="btn btn-success btn-flat active_page @if($loopingpages->status == '0') hide @endif" data-id="{{ $loopingpages->id }}" data-toggle="tooltip" title="Click to Inactive">Active</button>

                          <button id="inactive_{{ $loopingpages->id }}" class="btn btn-danger btn-flat active_page @if($loopingpages->status == '1') hide @endif" data-id="{{ $loopingpages->id }}" data-toggle="tooltip" title="Click to Active">Inactive</button>                              
                        </td>
                        <td>
                          <button class="btn btn-danger btn-flat delete_page" data-id="{{ $loopingpages->id }}" data-toggle="tooltip" title="Delete Page"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                          <a href="{{ route('admin.edit_page_form',['slug' => $loopingpages->slug]) }}" class="btn btn-warning btn-flat" data-toggle="tooltip" title="Edit Page"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                          <a href="{{ route('admin.view_page',['slug' => $loopingpages->slug]) }}" class="btn btn-info btn-flat" data-toggle="tooltip" title="View Page"><i class="fa fa-eye" aria-hidden="true"></i></a>                                                       
                       </td>

                     </tr>
                     @endforeach
                     @endif
                     
                                 
               </table>
            </div>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li>@if($pages){!! $pages->render() !!}@endif</li>
                </ul>
            </div>

            @endif            



            {{-- Searching Result Page Display --}}
            @if(isset($details))
            <div class="box-body table-responsive no-padding">
              <p> The Search results for your query <b class="cstm-bold"> {{ $query }} </b> are :</p>
              <table class="table table-hover table-bordered">
                  
                     <tr>
                        <th>Name</th>
                        <th>Url</th>
                        <th>Meta title</th>
                        <th>Meta keywords</th>
                        <th>Meta description</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  
                  
                  	 @if(!is_null($details))
                  	 @foreach($details as $loopingpages)
                     <tr class="tr_{{ $loopingpages->id }}">
                        <td>{{ $loopingpages->name }}</td>
                        <td>{{ $loopingpages->pageurl }}</td>
                        <td>{{ $loopingpages->metatitle }}</td>
                        <td>{{ $loopingpages->metakeywords }}</td>
                        <td>{{ $loopingpages->metadescription }}</td>
                        <td>
                          <button id="active_{{ $loopingpages->id }}" class="btn btn-success btn-flat active_page @if($loopingpages->status == '0') hide @endif" data-id="{{ $loopingpages->id }}" data-toggle="tooltip" title="Click to Inactive">Active</button>

                          <button id="inactive_{{ $loopingpages->id }}" class="btn btn-danger btn-flat active_page @if($loopingpages->status == '1') hide @endif" data-id="{{ $loopingpages->id }}" data-toggle="tooltip" title="Click to Active">Inactive</button>                              
                        </td>
                        <td>
                          <button class="btn btn-danger btn-flat delete_page" data-id="{{ $loopingpages->id }}" data-toggle="tooltip" title="Delete Page"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                          <a href="{{ route('admin.edit_page_form',['slug' => $loopingpages->slug]) }}" class="btn btn-warning btn-flat" data-toggle="tooltip" title="Edit Page"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                          <a href="{{ route('admin.view_page',['slug' => $loopingpages->slug]) }}" class="btn btn-info btn-flat" data-toggle="tooltip" title="View Page"><i class="fa fa-eye" aria-hidden="true"></i></a>                                                                   		      	
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
      $('#example1').dataTable( {
         'aoColumnDefs': [{
              'bSortable': false,
              'aTargets': ['no-sort']
          }]
      });   
        // $('#example1').dataTable({
        //     "bPaginate": true,
        //     "bLengthChange": false,
        //     "bFilter": false,
        //     "bSort": true,
        //     "bInfo": true,
        //     "bAutoWidth": false
        // });


// Deleting-Category
$(".delete_page").on("click", function() 
{    
  var confirmation = confirm("Are you sure you want to delete this page?");
  if (confirmation) 
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
  }
    
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


