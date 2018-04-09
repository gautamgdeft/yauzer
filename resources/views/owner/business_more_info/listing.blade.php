@extends('layouts.owner')
@section('content')

<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Biz More Info </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Biz More Info</li>
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
      <div class="box">
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="option-store x_panel">

  <div class="box-header info-1">
    <h3>More Info</h3>
  </div>         

     <!-- form start -->

     <form id="edit-business-info" role="form" action="{{ route('owner.update_main_info',['slug' => $business->slug]) }}" enctype="multipart/form-data" method="POST">

      {{ csrf_field() }}
        <div class="box-body">

           <input type="hidden" name="business_id" value="{{ $business->id }}">
           <input type="hidden" name="user_id" value="{{ $business->user_id }}">

           <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name">Business Info</label>
              <select class="businessInfo chosen-select form-control" name="name[]" multiple="true" required="required">
                
                @if(@sizeof($businessInfo))
                @foreach($businessInfo as $looping_predfined_infos)
                 
                  @if(@sizeof($existing_db_business_info))
                  <option value="{{ $looping_predfined_infos->id }}" @if(in_array($looping_predfined_infos->id, $existing_db_business_info)) selected="selected" @endif>{{ $looping_predfined_infos->name }}</option>
                  @else
                  <option value="{{ $looping_predfined_infos->id }}">{{ $looping_predfined_infos->name }}</option>
                  @endif
                 
                @endforeach
                @endif

              </select>  

              @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif

           </div>            


           <div class="form-group{{ $errors->has('businessInfo') ? ' has-error' : '' }}">
              <label for="businessInfo">Add New Business Info</label>
              <input type="text" name="businessInfo[]" data-role="tagsinput" class="form-control"> 

              @if ($errors->has('businessInfo'))
                <span class="help-block">
                    <strong>{{ $errors->first('businessInfo') }}</strong>
                </span>
              @endif

           </div>                     
                     

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
           <button id="update-businessInfp-form-btn" type="submit" class="btn btn-primary">Update</button>
        </div>
     </form>

            </div>
         </div>
      </div>
   </section>
</aside>
<!-- /.right-side -->
@endsection