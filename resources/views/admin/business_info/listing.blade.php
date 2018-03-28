@extends('layouts.admin')

@section('content')



<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Business More Info </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Business More Info</li>
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
               <a href="{{ route('business.add_more_info') }}" class="btn bg-olive btn-flat">Add New Info</a>


            <div class="box-tools">
                <form action="{{ route('businessinfo.search') }}" method="POST" role="search">
                  {{ csrf_field() }}
                  <div class="input-group">
                      <input type="text" name="search_parameter" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" value="@if(!empty($details)) {{ $query }} @endif"/>
                      <div class="input-group-btn">
                          <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                  </div>
                </form>

               @if(isset($details))
                <a href="{{ route('business.more_info_listing') }}" class="btn btn-danger btn-flat search-filter">Clear Filter</a>
               @endif     

            </div> 
            </div>
            <!-- /.box-header -->

          {{-- All Business Result Display --}}
          @if(isset($businessInfo))
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered" id="business_info_table">
                  
                     <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  
                  
                     @if(!is_null($businessInfo))
                     @foreach($businessInfo as $loopinglistings)
                     <tr class="tr_{{ $loopinglistings->id }}">
                        <td>{{ $loopinglistings->name }}</td>
                        <td>
                          <button id="active_{{ $loopinglistings->id }}" class="btn btn-success btn-flat active_info @if($loopinglistings->status == '0') hide @endif" data-id="{{ $loopinglistings->id }}" data-toggle="tooltip" title="Click to Inactive">Active</button>

                          <button id="inactive_{{ $loopinglistings->id }}" class="btn btn-danger btn-flat active_info @if($loopinglistings->status == '1') hide @endif" data-id="{{ $loopinglistings->id }}" data-toggle="tooltip" title="Click to Active">Inactive</button>                    
                        </td>
                        <td>
                          <button class="btn btn-danger btn-flat delete_info" data-id="{{ $loopinglistings->id }}" data-toggle="tooltip" title="Delete Business Info"><i class="fa fa-trash-o" aria-hidden="true"></i></button>

                          <a href="{{ route('admin.edit_form',['slug' => $loopinglistings->slug]) }}" class="btn btn-warning btn-flat" data-toggle="tooltip" title="Edit Business Info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                          {{-- <a href="" class="btn btn-info btn-flat" data-toggle="tooltip" title="View Business"><i class="fa fa-eye" aria-hidden="true"></i></a> --}}
                       </td>

                     </tr>
                     @endforeach
                     @endif
                 
               </table>
            </div>
                
              <p class="dum @if(@sizeof($businessInfo)) hide @endif">No Business Info found.</p>

              <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right">
                      <li>@if($businessInfo){!! $businessInfo->render() !!}@endif</li>
                  </ul>
              </div>
              @endif            


          {{-- Searching Result Business Display --}}
          @if(isset($details))
          <div class="box-body table-responsive no-padding">
            <p> The Search results for your query <b class="cstm-bold"> {{ $query }} </b> are :</p>
            <table class="table table-hover table-bordered" id="business_info_table">
                  
                     <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  
                  
                  	 @if(!is_null($details))
                  	 @foreach($details as $loopinglistings)
                      <tr class="tr_{{ $loopinglistings->id }}">
                        <td>{{ $loopinglistings->name }}</td>
                        <td>
                          <button id="active_{{ $loopinglistings->id }}" class="btn btn-success btn-flat active_info @if($loopinglistings->status == '0') hide @endif" data-id="{{ $loopinglistings->id }}" data-toggle="tooltip" title="Click to Inactive">Active</button>

                          <button id="inactive_{{ $loopinglistings->id }}" class="btn btn-danger btn-flat active_info @if($loopinglistings->status == '1') hide @endif" data-id="{{ $loopinglistings->id }}" data-toggle="tooltip" title="Click to Active">Inactive</button>                    
                        </td>
                        <td>
                          <button class="btn btn-danger btn-flat delete_info" data-id="{{ $loopinglistings->id }}" data-toggle="tooltip" title="Delete Business Info"><i class="fa fa-trash-o" aria-hidden="true"></i></button>

                          <a href="" class="btn btn-warning btn-flat" data-toggle="tooltip" title="Edit Business"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                          {{-- <a href="" class="btn btn-info btn-flat" data-toggle="tooltip" title="View Business"><i class="fa fa-eye" aria-hidden="true"></i></a> --}}
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
  <script src="{{ asset('js/admin/business_info.js') }}"></script>
@endsection


