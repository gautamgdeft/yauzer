@extends('layouts.admin')

@section('content')



<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Business Listing Premium Management </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Business Listing Premium Management</li>
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

            <div class="box-tools">
                <form action="{{ route('premium_business.search') }}" method="POST" role="search">
                  {{ csrf_field() }}
                  <div class="input-group">
                      <input type="text" name="search_parameter" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" value="@if(isset($details)) {{ $query }} @endif"/>
                      <div class="input-group-btn">
                          <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                  </div>
                </form>

               @if(isset($details))
                <a href="{{ route('admin.business_listing_premium') }}" class="btn btn-danger btn-flat search-filter">Clear Filter</a>
               @endif     

            </div> 
            </div>
            <!-- /.box-header -->

          {{-- All Business Result Display --}}
          @if(isset($business))
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered">
                  
                     <tr>
                        <th>Name</th>
                        <th>Business Owner</th>
                        <th>Business Added By</th>
                        <th>Email</th>
                        <th>Yauzers</th>
                        <th>Action</th>
                     </tr>
                  
                  
                     @if(@sizeof($business))
                     @foreach($business as $loopinglistings)
                     @if($loopinglistings->premium_status == false)
                     <tr class="tr_{{ $loopinglistings->id }}">
                        <td>{{ $loopinglistings->name }}</td>
                        <td>@if(@sizeof($loopinglistings->user)) <a data-toggle="tooltip" title="View Owner" href="{{ route('admin.show_owner',['slug' => $loopinglistings->user->slug]) }}">{{ $loopinglistings->user->name }}</a> @else No Owner Yet @endif</td>
                        <td>@if(@sizeof($loopinglistings->business_added_by)) <a data-toggle="tooltip" title="View User" href="{{ route('admin.show_owner',['slug' => $loopinglistings->business_added_by->slug]) }}">{{ $loopinglistings->business_added_by->name }}</a> @else No User @endif</td>
                        <td>{{ $loopinglistings->email }}</td>
                        <td>{{ $loopinglistings->yauzers->count() }}</td>
                        <td>
                          <button id="premiumEmail_{{ $loopinglistings->id }}" class="btn btn-success btn-flat send_premiumEmail" data-id="{{ $loopinglistings->id }}" data-toggle="tooltip" title="Send Owner Premium Email"><i class="fa fa-envelope" aria-hidden="true"></i> Send Premium Business Email</button>                          
                        </td>

                     </tr>
                     @endif
                     @endforeach
                     @endif

                  
               </table>
            </div>

              <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right">
                      <li>@if($business){!! $business->render() !!}@endif</li>
                  </ul>
              </div>
              @endif            


          {{-- Searching Result Business Display --}}
          @if(isset($details))
          <div class="box-body table-responsive no-padding">
            <p> The Search results for your query <b class="cstm-bold"> {{ $query }} </b> are :</p>
            <table class="table table-hover table-bordered">
                  
                     <tr>
                        <th>Name</th>
                        <th>Business Owner</th>
                        <th>Email</th>
                        <th>Yauzers</th>
                        <th>Action</th>
                     </tr>
                  
                  
                     @if(!is_null($details))
                     @foreach($details as $loopinglistings)
                     @if($loopinglistings->premium_status == false)

                     <tr class="tr_{{ $loopinglistings->id }}">
                        <td>{{ $loopinglistings->name }}</td>
                        <td>@if(@sizeof($loopinglistings->user)) {{ $loopinglistings->user->name }} @else Deleted User @endif</td>
                        <td>{{ $loopinglistings->email }}</td>
                        <td>{{ $loopinglistings->yauzers->count() }}</td>
                        <td>
                          <button id="premiumEmail_{{ $loopinglistings->id }}" class="btn btn-success btn-flat send_premiumEmail" data-id="{{ $loopinglistings->id }}" data-toggle="tooltip" title="Send Owner Premium Email"><i class="fa fa-envelope" aria-hidden="true"></i> Send Premium Business Email</button>                              
                        </td>

                     </tr>
                     @endif
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

            <p class="dum @if(@sizeof($business) || ($details) || (isset($message))) hide @endif">No Premium Business Found Yet.</p>             
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
 <script type="text/javascript">
   $('.send_premiumEmail').click(function(){
     var btn = $(this);
     $(this).html('Sending Email. Please wait...').removeClass('btn btn-success').addClass('btn btn-danger').prop('disabled', true);
     var businessId = $(this).data('id');
     $.ajax({
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
              url: "/admin/send-business-premium-email",
              type: "Post",
              dataType: "JSON",
              data: {businessId: businessId},
              success: function(response)
                   {
                    if ( response.status === 'success' ) 
                    {
                     btn.html('Send Owner Premium Email').removeClass('btn btn-danger').addClass('btn btn-success').prop('disabled', false); 
                     $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
                    }
                 },
                 error: function( response ) 
                 {
                   if ( response.status === 422 ) 
                   {
                     btn.html('Send Owner Premium Email').removeClass('btn btn-danger').addClass('btn btn-success').prop('disabled', false);
                     $('#msgs').html("<div class='alert alert-error'>"+response.msg+"</div>");
                   }
                 }
     });
   });
 </script>
@endsection


