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
    <div class="box-header">
    <a id="export" data-export="export" class="btn bg-olive btn-flat"><i class="fa fa-cloud-download"></i> Export Contacts</a> 

    <div class="box-tools src-filter">
        <form action="{{ route('contact.search') }}" method="POST" role="search">
          {{ csrf_field() }}
          <div class="input-group">
              <input type="text" name="search_parameter" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" value="@if(isset($details)) {{ $query }} @endif"/>
              <div class="input-group-btn">
                  <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
              </div>
          </div>
        </form>

        @if(isset($details))
          <a href="{{ route('admin.contactListing') }}" class="btn btn-danger btn-flat search-filter">Clear Filter</a>
        @endif

       <form action="{{ route('contact.search_by_date') }}" id="filter_by_date" method="POST" role="search">
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

        @if(isset($filter))
          <a href="{{ route('admin.contactListing') }}" class="btn btn-danger btn-flat search-filter">Clear Filter</a>
        @endif    

    </div>      
   </div>    
     <!-- /.box-header -->

    {{-- All Contacts Result Display --}}
    @if(isset($contact_listing))
    <div class="box-body table-responsive no-padding">
      <table class="table table-hover table-bordered" id="export_table">
        
         <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Message</th>
          <th>Action</th>
        </tr>
      
      
        @if(!is_null($contact_listing))
        @foreach($contact_listing as $loopingcontacts)
        <tr class="tr_{{ $loopingcontacts->id }}">
          <td>{{ $loopingcontacts->name }}</td>
          <td>{{ $loopingcontacts->email }}</td>
          <td>{{ $loopingcontacts->message }}</td>
          <td>
            <button class="btn btn-danger btn-flat delete_contact" data-id="{{ $loopingcontacts->id }}" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
            <a href="{{ route('admin.contactdetail', ['id' => $loopingcontacts->id]) }}" class="btn btn-info btn-flat" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
          </td>

        </tr>
        @endforeach
        @endif

  </table>
</div>

<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <li>@if($contact_listing){!! $contact_listing->render() !!}@endif</li>
    </ul>
</div>

@endif     

    {{-- Searching Result Contacts Display --}}
    @if(isset($filter) && !isset($details))
    <div class="box-body table-responsive no-padding">
      <p> The Search results for your query from <b class="cstm-bold"> {{ $start }} </b> to <b class="cstm-bold"> {{ $end }} </b> are :</p>
      <table class="table table-hover table-bordered" id="export_table">
        
         <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Message</th>
          <th>Action</th>
        </tr>
      
      
        @if(!is_null($filter))
        @foreach($filter as $loopingcontacts)
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
   
  </table>
</div>

<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <li>@if($filter){!! $filter->render() !!}@endif</li>
    </ul>
</div>

@elseif(isset($error))
<p>{{ $error }}</p>
@endif 

    {{-- Searching Result Contacts Display --}}
    @if(isset($details) && !isset($filter))
    <div class="box-body table-responsive no-padding">
      <p> The Search results for your query <b class="cstm-bold"> {{ $query }} </b> are :</p>
      <table class="table table-hover table-bordered" id="export_table">
        
         <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Message</th>
          <th>Action</th>
        </tr>
      
      
        @if(!is_null($details))
        @foreach($details as $loopingcontacts)
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

  //Adding-Validations-On-Business-Form
  $('#filter_by_date').validate({
  onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
  },

  highlight: function(element) {
    $('element').removeClass("error");
  },

  rules: {

      valueToBeTested: {
          required: true,
      }

    },  
  });     

  $('#filter_by_date_btn').click(function()
  {
    if($('#filter_by_date').valid())
    {
      $('#filter_by_date_btn').prop('disabled', true);
      $('#filter_by_date').submit();
    }else{
      return false;
    }
  }); 


// Deleting-Contact
$(".delete_contact").on("click", function() 
{    
  var confirmation = confirm("Are you sure you want to delete this?");
  if (confirmation) 
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
  }

});

//Export Functionality as CSV
$("#export").click(function(){
    $("#export_table").tableToCSV();
});

});    
</script>
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

 <script src="{{ asset('js/user/jquery.tabletoCSV.js') }}"></script>
@endsection


  