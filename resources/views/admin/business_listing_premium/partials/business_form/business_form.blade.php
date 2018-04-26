  <div class="box-header detail-1">
    <h3>Details</h3>
  </div>   

             <!-- form start -->
             <form id="edit-business-form" role="form" action="{{ route('admin.update_business',['slug' => $businessListing->slug]) }}" enctype="multipart/form-data" method="POST">
              {{ csrf_field() }}
                <div class="box-body">

                   <!--Hidden Fields-->
                   <input type="hidden" name="latitude" id="latitude" value="{{ $businessListing->latitude }}">
                   <input type="hidden" name="longitude" id="longitude" value="{{ $businessListing->longitude }}">

                   <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{ $businessListing->name }}" required="required">

                      @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                      @endif

                   </div>               

                   <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email">Email Address</label>
                      <input type="email" class="form-control" id="email" name="email" value="{{ $businessListing->email }}" disabled>

                      @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                      @endif

                   </div>

                   <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                      <label for="country">Country</label>
                      <select class="form-control" id="country" name="country" value="{{ old('country') }}" required="required">
                      <option value="">Choose Country</option>  
                      @if(!is_null($country))
                        @foreach($country as $loopingCountries)  
                        <option value="{{ $loopingCountries }}" @if($loopingCountries == $businessListing->country) selected="selected" @endif >{{ $loopingCountries }}</option>
                        @endforeach
                      @endif
                      </select>  

                      @if ($errors->has('country'))
                        <span class="help-block">
                            <strong>{{ $errors->first('country') }}</strong>
                        </span>
                      @endif

                   </div> 

                   <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" id="address" name="address" value="{{ $businessListing->address }}" required="required">

                      @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                      @endif

                   </div>


                   <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                      <label for="address">City</label>
                      <input type="text" class="form-control" id="city" name="city" value="{{ $businessListing->city }}" required="required">

                      @if ($errors->has('city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                      @endif

                   </div>


                   <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                      <label for="address">State</label>
                      <input type="text" class="form-control" id="state" name="state" value="{{ $businessListing->state }}" required="required">

                      @if ($errors->has('state'))
                        <span class="help-block">
                            <strong>{{ $errors->first('state') }}</strong>
                        </span>
                      @endif

                   </div>

                   <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                      <label for="zipcode">Zipcode</label>
                      <input type="text" class="form-control" id="zipcode" name="zipcode" value="{{ $businessListing->zipcode }}" required="required">

                      @if ($errors->has('zipcode'))
                        <span class="help-block">
                            <strong>{{ $errors->first('zipcode') }}</strong>
                        </span>
                      @endif

                   </div>

                   <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                      <label for="phone_number">Phone Number</label>
                      <input type="text" class="form-control input-medium bfh-phone" id="phone_number" name="phone_number" value="{{ $businessListing->phone_number }}" data-country="US" data-number="{{ $businessListing->phone_number }}" required="required">

                      @if ($errors->has('phone_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone_number') }}</strong>
                        </span>
                      @endif

                   </div>                

                   <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                      <label for="website">Website</label>
                      <input type="text" class="form-control" id="website" name="website" value="{{ $businessListing->website }}" required="required">

                      @if ($errors->has('website'))
                        <span class="help-block">
                            <strong>{{ $errors->first('website') }}</strong>
                        </span>
                      @endif

                   </div>                                                                                                             

                   <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                      <label for="avatar">Business Main Image</label>
                      <input type="file" id="avatar" name="avatar" class="form-control" onchange="ValidateSingleInput(this);">

                      @if ($errors->has('avatar'))
                        <span class="help-block">
                            <strong>{{ $errors->first('avatar') }}</strong>
                        </span>
                      @endif

                      <img id="image_src" class="img-circle" src="/uploads/businessAvatars/{{ $businessListing->avatar }}" style="height: 45px; width: 45px;">
                   </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                   <button id="submit-business-form-btn" type="submit" class="btn btn-primary">Update</button>
                   <a href="{{ URL::previous() }}" class="btn btn-warning">Go Back</a>
                </div>
             </form>            