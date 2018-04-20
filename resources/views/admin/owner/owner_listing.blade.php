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

              <div class="box-tools">
                  <form action="{{ route('owner.search') }}" method="POST" role="search">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" name="search_parameter" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" value="@if(isset($details)) {{ $query }} @endif"/>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                  </form>

               @if(isset($details))
                <a href="{{ route('admin.owners') }}" class="btn btn-danger btn-flat search-filter">Clear Filter</a>
               @endif  

              </div>                 
            </div>
            <!-- /.box-header -->

            {{-- All Owners Result Display --}}
            @if(isset($allusers))
            <div class="box-body table-responsive no-padding">
               <table class="table table-hover table-bordered">
                     <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Business Name</th>
                        <th>Image</th>
                        <th>Owner Status</th>
                        {{-- <th>Registration Status</th> --}}
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  
                  	 @if(!is_null($allusers))
                  	 @foreach($allusers as $loopingUsers)

                     <tr class="tr_{{ $loopingUsers->id }}">
                        <td>{{ $loopingUsers->name }}</td>
                        <td>{{ $loopingUsers->email }}</td>
                        <td>
                          @if(sizeof($loopingUsers->businesses)) 
                            @foreach($loopingUsers->businesses as $businesses)
                              <p class="info-top pull-right tooltip1"> {{ $businesses->name }} <i class="fa fa-info-circle display_info" data-toggle="tooltip" title="<b>Business Address:</b> {{ $businesses->address }}</br><b>Phone Number:</b> {{ $businesses->phone_number }}</br><b>Email:</b> {{ $businesses->email }}</br><b>Website:</b> {{ $businesses->website }}</br>" data-html="true" data-business-id = "{{ $businesses->id }}"></i></p>
                            @endforeach
                          @else
                            <p>No Business Yet</p>
                          @endif 
                        </td>
                        <td><img id="image_src" class="img-circle" src="/uploads/avatars/{{ $loopingUsers->avatar }}" style="height: 45px; width: 45px;"></td>

                        <td>
 							            <button id="activate_user_{{ $loopingUsers->id }}" class="btn btn-danger btn-flat activate_user @if($loopingUsers->login_status == '1') hide @endif" data-id="{{ $loopingUsers->id }}" data-toggle="tooltip" title="Click to Activate Customer">Inactive</button>

	                        <button id="inactivate_user_{{ $loopingUsers->id }}" class="btn btn-success btn-flat activate_user @if($loopingUsers->login_status == '0') hide @endif" data-id="{{ $loopingUsers->id }}" data-toggle="tooltip" title="Click to Inactivate Customer">Active</button>                        	
                        </td>

{{--                         <td>
	                        <button id="accept_reg_{{ $loopingUsers->id }}" class="btn btn-success btn-flat accept_reg @if($loopingUsers->registeration_status == '1') hide @endif" data-id="{{ $loopingUsers->id }}" data-toggle="tooltip" title="Click to Accept Registration">Accept</button>

	                        <button id="reject_reg_{{ $loopingUsers->id }}" class="btn btn-danger btn-flat accept_reg @if($loopingUsers->registeration_status == '0') hide @endif" data-id="{{ $loopingUsers->id }}" data-toggle="tooltip" title="Click to Reject Registration">Reject</button>  
                        </td> --}}
                        @if(@sizeof($loopingUsers->business))
                        <td>{!! $loopingUsers->business->premium_status == true? html_entity_decode('<button class="btn btn-success btn-flat">Premium</button>') : html_entity_decode('<button class="btn btn-danger btn-flat">Basic</button>') !!}</td>
                        @else
                         <td>No Business</td> 
                        @endif

                        <td><button class="btn btn-danger btn-flat delete_user" data-id="{{ $loopingUsers->id }}" data-toggle="tooltip" title="Delete Owner"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        <a href="{{ route('admin.edit_owner_form',['slug' => $loopingUsers->slug]) }}" class="btn btn-warning btn-flat" data-toggle="tooltip" title="Edit Owner"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
             			      <a href="{{ route('admin.show_owner',['slug' => $loopingUsers->slug]) }}" class="btn btn-info btn-flat" data-toggle="tooltip" title="View Owner"><i class="fa fa-eye" aria-hidden="true"></i></a>
                       </td>

                     </tr>
                     @endforeach
                     @endif

               </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li>@if($allusers){!! $allusers->render() !!}@endif</li>
                </ul>
            </div>

            @endif

            {{-- Searching Result Owner Display --}}
            @if(isset($details))
            <div class="box-body table-responsive no-padding">
              <p> The Search results for your query <b class="cstm-bold"> {{ $query }} </b> are :</p>
               <table class="table table-hover table-bordered">
                     <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Customer Status</th>
                        <th>Registeration Status</th>
                        <th>Action</th>
                     </tr>
                  
                     @if(!is_null($details))
                     @foreach($details as $loopingUsers)

                     <tr class="tr_{{ $loopingUsers->id }}">
                        <td>{{ $loopingUsers->name }}</td>
                        <td>{{ $loopingUsers->email }}</td>
                        <td><img id="image_src" class="img-circle" src="/uploads/avatars/{{ $loopingUsers->avatar }}" style="height: 45px; width: 45px;"></td>

                        <td>
                          <button id="activate_user_{{ $loopingUsers->id }}" class="btn btn-success btn-flat activate_user @if($loopingUsers->login_status == '1') hide @endif" data-id="{{ $loopingUsers->id }}" data-toggle="tooltip" title="Click to Activate Customer">Activate Customer</button>

                          <button id="inactivate_user_{{ $loopingUsers->id }}" class="btn btn-danger btn-flat activate_user @if($loopingUsers->login_status == '0') hide @endif" data-id="{{ $loopingUsers->id }}" data-toggle="tooltip" title="Click to Inactivate Customer">Inactivate Customer</button>                          
                        </td>

                        <td>
                          <button id="accept_reg_{{ $loopingUsers->id }}" class="btn btn-success btn-flat accept_reg @if($loopingUsers->registeration_status == '1') hide @endif" data-id="{{ $loopingUsers->id }}" data-toggle="tooltip" title="Click to Accept Registration">Accept</button>

                          <button id="reject_reg_{{ $loopingUsers->id }}" class="btn btn-danger btn-flat accept_reg @if($loopingUsers->registeration_status == '0') hide @endif" data-id="{{ $loopingUsers->id }}" data-toggle="tooltip" title="Click to Reject Registration">Reject</button>  
                        </td>

                        <td><button class="btn btn-danger btn-flat delete_user" data-id="{{ $loopingUsers->id }}" data-toggle="tooltip" title="Delete Owner"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        <a href="{{ route('admin.edit_owner_form',['slug' => $loopingUsers->slug]) }}" class="btn btn-warning btn-flat" data-toggle="tooltip" title="Edit Owner"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a href="{{ route('admin.show_customer',['slug' => $loopingUsers->slug]) }}" class="btn btn-info btn-flat" data-toggle="tooltip" title="View Owner"><i class="fa fa-eye" aria-hidden="true"></i></a>
                       </td>

                     </tr>
                     @endforeach
                     @endif
                  
               </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li>@if($details){!! $details->render() !!}@endif</li>
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


// Deleting-Simple-User

$(".delete_user").on("click", function() 
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
$(".accept_reg").on("click", function() 
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
$(".activate_user").on("click", function() 
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
				   $('#activate_user_'+user_id).html('Inactive');	
				   $('#activate_user_'+user_id).addClass('hide');
				   $('#inactivate_user_'+user_id).removeClass('hide');
				   $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
				}else{
				   $('#inactivate_user_'+user_id).html('Active');	
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


