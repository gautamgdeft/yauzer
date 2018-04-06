  <div class="box-header adds-1">
    <h3>Adds</h3>
  </div>   

     <!-- form start -->

     <form id="edit-interested_businesses-form" role="form" action="{{ route('admin.update_interested_business',['slug' => $businessListing->slug]) }}" enctype="multipart/form-data" method="POST">
      {{ csrf_field() }}
        <div class="box-body">

           <input type="hidden" name="business_id" value="{{ $businessListing->id }}">

           <div class="form-group{{ $errors->has('interested_businesses') ? ' has-error' : '' }}">
              <label for="interested_businesses">Business Name</label>
              <select class="limitedNumbChosen chosen-select form-control" name="interested_businesses[]" multiple="true" required="required">
                
                @if(@sizeof($allBusinesses))
                @foreach($allBusinesses as $looping_businesses)
                 
                  @if(@sizeof($intersetedBusinesses->interested_businesses))
                  <option value="{{ $looping_businesses->id }}" @if(in_array($looping_businesses->id, $intersetedBusinesses->interested_businesses)) selected="selected" @endif>{{ $looping_businesses->name }}</option>
                  @else
                  <option value="{{ $looping_businesses->id }}">{{ $looping_businesses->name }}</option>
                  @endif
                 
                @endforeach
                @endif

              </select>  

              @if ($errors->has('interested_businesses'))
                <span class="help-block">
                    <strong>{{ $errors->first('interested_businesses') }}</strong>
                </span>
              @endif

           </div>                     
                     

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
           <button id="update-interested_businesses-form-btn" type="submit" class="btn btn-primary">Update</button>
           <a href="{{ URL::previous() }}" class="btn btn-warning">Go Back</a>
        </div>
     </form>
