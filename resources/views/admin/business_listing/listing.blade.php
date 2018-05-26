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

 <section class="content basic-listing-page">
   <div class="row">
      <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
                <a id="export" data-export="export" class="btn bg-olive btn-flat"><i class="fa fa-cloud-download"></i> Export Businesses</a>

            <div class="box-tools src-filter">
                <form action="{{ route('business.search') }}" method="POST" role="search">
                  {{ csrf_field() }}
                  <div class="input-group">
                      <input type="text" name="search_parameter" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" value="@if(isset($details)) {{ $query }} @endif"/>
                      <div class="input-group-btn">
                          <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                  </div>
                </form>

               @if(isset($details))
                <a href="{{ route('admin.business_listing') }}" class="btn btn-danger btn-flat search-filter">Clear Filter</a>
               @endif    

                 <form action="{{ route('business.search_by_date_business') }}" id="filter_by_date" method="POST" role="search">
                    {{ csrf_field() }}
                  <div class="input-group date-group">
                        <div class="start">
                        <label>Start-Date</label>
                        <input type="text" id="start" name="start" class="form-control input-sm pull-right" style="width: 150px;" value="@if(isset($filter)) {{ $start }} @endif" placeholder="Start Date" required />
                        </div>

                        <div class="end">
                        <label>End-Date</label>
                        <input type="text" id="end" name="end" class="form-control input-sm pull-right" style="width: 150px;" value="@if(isset($filter)) {{ $end }} @endif" placeholder="End Date" required />
                        </div>

                        <div class="input-group-btn">
                            <button type="submit" id="filter_by_date_btn" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>              
                  </div> 
                  </form>                

            </div> 
            </div>
            <!-- /.box-header -->

          {{-- All Business Result Display --}}
          @if(isset($business_listing))
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered" id="export_table">
                  
                     <tr>
                        <th>@sortablelink('name')</th>
                        <th>@sortablelink('ownername', 'Business Owner')</th>
                        <th>@sortablelink('coownername', 'Business Added By')</th>
                        <th>@sortablelink('email')</th>
                        <th>@sortablelink('yauzer')</th>
                        <th>@sortablelink('created_at', 'Created At')</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  
                  
                     @if(!is_null($business_listing))
                     @foreach($business_listing as $loopinglistings)
                     <tr class="tr_{{ $loopinglistings->id }}">
                        <td>{{ $loopinglistings->name }}</td>
                        <td>@if(@sizeof($loopinglistings->user)) <a data-toggle="tooltip" title="View Owner" href="{{ route('admin.show_owner',['slug' => $loopinglistings->user->slug]) }}">{{ $loopinglistings->user->name }}</a> @else No Owner Yet @endif</td>
                        <td>@if(@sizeof($loopinglistings->business_added_by)) <a data-toggle="tooltip" title="View User" href="{{ route('admin.show_owner',['slug' => $loopinglistings->business_added_by->slug]) }}">{{ $loopinglistings->business_added_by->name }}</a> @else No User @endif</td>
                        <td>{{ $loopinglistings->email }}</td>
                        <td>{{ $loopinglistings->yauzers->count() }}</td>
                        <td>{{ Carbon\Carbon::parse($loopinglistings->created_at)->format('m/d/Y') }}</td>
                        <td>
                          <button id="approve_business_{{ $loopinglistings->id }}" class="btn btn-danger btn-flat approve_business @if($loopinglistings->status == '1') hide @else ok @endif" data-id="{{ $loopinglistings->id }}" data-toggle="tooltip" title="Click to Active">Inactive</button>

                          <button id="reject_business_{{ $loopinglistings->id }}" class="btn btn-success btn-flat approve_business @if($loopinglistings->status == '0') hide @else ok @endif" data-id="{{ $loopinglistings->id }}" data-toggle="tooltip" title="Click to Inactive">Active</button>                               
                        </td>
                        <td>
                          <button class="btn btn-danger btn-flat delete_business" data-id="{{ $loopinglistings->id }}" data-toggle="tooltip" title="Delete Business"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                          <a href="{{ route('admin.show_edit_business_form',['slug' => $loopinglistings->slug]) }}" class="btn btn-warning btn-flat" data-toggle="tooltip" title="Edit Business"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                          {{-- <a href="{{ route('admin.show_business_hours_form',['slug' => $loopinglistings->slug]) }}" class="btn btn-warning btn-flat">Edit Hours</a> --}}
                          <a href="{{ route('admin.show_business',['slug' => $loopinglistings->slug]) }}" class="btn btn-info btn-flat" data-toggle="tooltip" title="View Business"><i class="fa fa-eye" aria-hidden="true"></i></a>
                          <a href="{{ route('admin.change_biz_status',['slug' => $loopinglistings->slug]) }}" class="btn btn-info btn-flat" data-toggle="tooltip" title="Change Status"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                       </td>

                     </tr>
                     @endforeach
                     @endif

                  
               </table>
            </div>

              <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right">
                      <li>@if($business_listing){!! $business_listing->render() !!}@endif</li>
                  </ul>
              </div>
              @endif            


          {{-- Searching Result Business Display --}}
          @if(isset($details) && !isset($filter))
          <div class="box-body table-responsive no-padding">
            <p> The Search results for your query <b class="cstm-bold"> {{ $query }} </b> are :</p>
            <table class="table table-hover table-bordered" id="export_table">
                  
                     <tr>
                        <th>@sortablelink('name')</th>
                        <th>@sortablelink('ownername', 'Business Owner')</th>
                        <th>@sortablelink('coownername', 'Business Added By')</th>
                        <th>@sortablelink('email')</th>
                        <th>@sortablelink('yauzer')</th>
                        <th>@sortablelink('created_at', 'Created At')</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  
                  
                  	 @if(!is_null($details))
                  	 @foreach($details as $loopinglistings)
                     <tr class="tr_{{ $loopinglistings->id }}">
                        <td>{{ $loopinglistings->name }}</td>
                        <td>@if(@sizeof($loopinglistings->user)) <a data-toggle="tooltip" title="View Owner" href="{{ route('admin.show_owner',['slug' => $loopinglistings->user->slug]) }}">{{ $loopinglistings->user->name }}</a> @else No Owner Yet @endif</td>
                        <td>@if(@sizeof($loopinglistings->business_added_by)) <a data-toggle="tooltip" title="View User" href="{{ route('admin.show_owner',['slug' => $loopinglistings->business_added_by->slug]) }}">{{ $loopinglistings->business_added_by->name }}</a> @else No User @endif</td>
                        <td>{{ $loopinglistings->email }}</td>
                        <td>{{ $loopinglistings->yauzers->count() }}</td>
                        <td>{{ Carbon\Carbon::parse($loopinglistings->created_at)->format('m/d/Y') }}</td>
                        <td>
                          <button id="approve_business_{{ $loopinglistings->id }}" class="btn btn-success btn-flat approve_business @if($loopinglistings->status == '1') hide @else ok @endif" data-id="{{ $loopinglistings->id }}" data-toggle="tooltip" title="Click to Active">Inactive</button>

                          <button id="reject_business_{{ $loopinglistings->id }}" class="btn btn-danger btn-flat approve_business @if($loopinglistings->status == '0') hide @else ok @endif" data-id="{{ $loopinglistings->id }}" data-toggle="tooltip" title="Click to Inactive">Active</button>                               
                        </td>
                        <td>
                          <button class="btn btn-danger btn-flat delete_business" data-id="{{ $loopinglistings->id }}" data-toggle="tooltip" title="Delete Business"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                          <a href="{{ route('admin.show_edit_business_form',['slug' => $loopinglistings->slug]) }}" class="btn btn-warning btn-flat" data-toggle="tooltip" title="Edit Business"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                          {{-- <a href="{{ route('admin.show_business_hours_form',['slug' => $loopinglistings->slug]) }}" class="btn btn-warning btn-flat">Edit Hours</a> --}}
               		      	<a href="{{ route('admin.show_business',['slug' => $loopinglistings->slug]) }}" class="btn btn-info btn-flat" data-toggle="tooltip" title="View Business"><i class="fa fa-eye" aria-hidden="true"></i></a>
                          <a href="{{ route('admin.change_biz_status',['slug' => $loopinglistings->slug]) }}" class="btn btn-info btn-flat" data-toggle="tooltip" title="Change Status"><i class="fa fa-refresh" aria-hidden="true"></i></a>                          
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

            {{-- Searching Result Customer Display --}}
           @if(isset($filter) && !isset($details))
          <div class="box-body table-responsive no-padding">
            <p> The Search results for your query from <b class="cstm-bold"> {{ $start }} </b> to <b class="cstm-bold"> {{ $end }} </b> are :</p>
            <table class="table table-hover table-bordered" id="export_table">
                  
                     <tr>
                        <th>@sortablelink('name')</th>
                        <th>@sortablelink('ownername', 'Business Owner')</th>
                        <th>@sortablelink('coownername', 'Business Added By')</th>
                        <th>@sortablelink('email')</th>
                        <th>@sortablelink('yauzer')</th>
                        <th>@sortablelink('created_at', 'Created At')</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  
                  
                     @if(!is_null($filter))
                     @foreach($filter as $loopinglistings)
                     <tr class="tr_{{ $loopinglistings->id }}">
                        <td>{{ $loopinglistings->name }}</td>
                        <td>@if(@sizeof($loopinglistings->user)) <a data-toggle="tooltip" title="View Owner" href="{{ route('admin.show_owner',['slug' => $loopinglistings->user->slug]) }}">{{ $loopinglistings->user->name }}</a> @else No Owner Yet @endif</td>
                        <td>@if(@sizeof($loopinglistings->business_added_by)) <a data-toggle="tooltip" title="View User" href="{{ route('admin.show_owner',['slug' => $loopinglistings->business_added_by->slug]) }}">{{ $loopinglistings->business_added_by->name }}</a> @else No User @endif</td>
                        <td>{{ $loopinglistings->email }}</td>
                        <td>{{ $loopinglistings->yauzers->count() }}</td>
                        <td>{{ Carbon\Carbon::parse($loopinglistings->created_at)->format('m/d/Y') }}</td>
                        <td>
                          <button id="approve_business_{{ $loopinglistings->id }}" class="btn btn-success btn-flat approve_business @if($loopinglistings->status == '1') hide @else ok @endif" data-id="{{ $loopinglistings->id }}" data-toggle="tooltip" title="Click to Active">Inactive</button>

                          <button id="reject_business_{{ $loopinglistings->id }}" class="btn btn-danger btn-flat approve_business @if($loopinglistings->status == '0') hide @else ok @endif" data-id="{{ $loopinglistings->id }}" data-toggle="tooltip" title="Click to Inactive">Active</button>                               
                        </td>
                        <td>
                          <button class="btn btn-danger btn-flat delete_business" data-id="{{ $loopinglistings->id }}" data-toggle="tooltip" title="Delete Business"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                          <a href="{{ route('admin.show_edit_business_form',['slug' => $loopinglistings->slug]) }}" class="btn btn-warning btn-flat" data-toggle="tooltip" title="Edit Business"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                          {{-- <a href="{{ route('admin.show_business_hours_form',['slug' => $loopinglistings->slug]) }}" class="btn btn-warning btn-flat">Edit Hours</a> --}}
                          <a href="{{ route('admin.show_business',['slug' => $loopinglistings->slug]) }}" class="btn btn-info btn-flat" data-toggle="tooltip" title="View Business"><i class="fa fa-eye" aria-hidden="true"></i></a>
                          <a href="{{ route('admin.change_biz_status',['slug' => $loopinglistings->slug]) }}" class="btn btn-info btn-flat" data-toggle="tooltip" title="Change Status"><i class="fa fa-refresh" aria-hidden="true"></i></a>                          
                       </td>

                     </tr>
                     @endforeach
                     @endif

                  
               </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li>@if($filter){!! $filter->render() !!}@endif</li>
                </ul>
            </div>

            @elseif(isset($message))
            <p>{{ $message }}</p>
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
        // $('#example1').dataTable( {
        //    'aoColumnDefs': [{
        //         'bSortable': false,
        //         'aTargets': ['no-sort']
        //     }]
        // });    
        // $('#example1').dataTable({
        //     "bPaginate": true,
        //     "bLengthChange": false,
        //     "bFilter": false,
        //     "bSort": true,
        //     "bInfo": true,
        //     "bAutoWidth": false
        // });


// Deleting-Category
$(".delete_business").on("click", function() 
{  
  var confirmation = confirm("Are you sure you want to delete this business?");
  if (confirmation) 
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
  }
    
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
                   $('#approve_business_'+business_id).html('Inactive');  
                   $('#approve_business_'+business_id).addClass('hide');
                   $('#reject_business_'+business_id).removeClass('hide');
                   $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
                }else{
                   $('#reject_business_'+business_id).html('Active'); 
                   $('#reject_business_'+business_id).addClass('hide');         
                   $('#approve_business_'+business_id).removeClass('hide');
                   $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
                }
            }

        });    

});



//Export Functionality as CSV
$("#export").click(function(){
    $("#export_table").tableToCSV();
})

    });    
</script>
<script src="{{ asset('js/user/jquery.tabletoCSV.js') }}"></script>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">
    $(function(){$("#start").datepicker({
            autoclose:!0,
            format:"yyyy-mm-dd",
            todayHighlight: true
        }),
        $("#end").datepicker({
            autoclose:!0,
            format:"yyyy-mm-dd",
            todayHighlight: true
        })
    });   
</script>
@endsection


