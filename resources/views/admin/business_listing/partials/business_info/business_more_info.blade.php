  <div class="box-header info-1">
    <h3>More Info</h3>
  </div>         

     <!-- form start -->

     <form id="edit-business-info" role="form" action="{{ route('admin.update_main_info',['slug' => $businessListing->slug]) }}" enctype="multipart/form-data" method="POST">

      {{ csrf_field() }}
        <div class="box-body">

           <input type="hidden" name="business_id" value="{{ $businessListing->id }}">
           <input type="hidden" name="user_id" value="{{ $businessListing->user_id }}">

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
           <a href="{{ URL::previous() }}" class="btn btn-warning">Go Back</a>
        </div>
     </form>
