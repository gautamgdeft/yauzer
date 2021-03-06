@extends('layouts.user')

@section('content')

<div class="blog-form-wrapper create-listing list-new">
<div class="container">
    <div class="row profile">
		<div class="col-md-3 col-sm-12">
     
     <!--Adding Dashboard Sidebar Partial--> 
      @include('user/dashboard/partials/dashboard_sidebar')

		</div>

<div class="col-md-9 col-sm-12">
   <div class="profile-content">
      <div id="msgs">
         @if(session('success'))
         <div class="alert alert-success">
            {{ session('success') }}
         </div>
         @endif
      </div>
      <div class="card">
         <div class="header">
            <h4 class="title">Edit Profile</h4>
         </div>
         <div class="content">
            <form id="user_profile_form" name="user_profile_form" method="POST" action="{{ route('user.update_profile') }}" enctype="multipart/form-data">
               {{ csrf_field() }}
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>First Name<span>*</span></label>
                        <input type="text" class="form-control border-input" placeholder="First Name" name="firstname" value="{{ strtok(Auth::user()->name, ' ') }}" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control border-input" placeholder="Last Name" name="lastname" value="@if(!empty($splitName[1])){{ $splitName['1'] }}@endif">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Email Address<span>*</span></label>
                        <input type="text" class="form-control border-input" disabled="" placeholder="Email Address" name="email" value="{{ Auth::user()->email }}" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control border-input input-medium bfh-phone" placeholder="Phone number" data-country="US" data-number="{{ Auth::user()->phone_number }}" name="phone_number" value="{{ Auth::user()->phone_number }}">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control border-input" placeholder="City" name="city" value="{{ Auth::user()->city }}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control border-input" placeholder="State" name="state" value="{{ Auth::user()->state }}">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Country</label>
                        <select class="form-control border-input" id="country" name="country" value="{{ old('country') }}">
                           <option value="">Choose Country</option>
                           @if(!is_null($countries))
                           @foreach($countries as $loopingCountries)  
                           <option value="{{ $loopingCountries }}" @if($loopingCountries == Auth::user()->country) selected="selected" @endif >{{ $loopingCountries }}</option>
                           @endforeach
                           @endif
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Zip Code</label>
                        <input type="text" class="form-control border-input" id="zipcode" placeholder="ZIP Code" name="zipcode" value="{{ Auth::user()->zipcode }}">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Age Group</label>
                        <select class="form-control border-input" id="agegroup" name="age_group">
                           <option value="">Choose Age Group</option>
                           @if(!is_null($agegroups))
                           @foreach($agegroups as $loopingages)  
                           <option value="{{ $loopingages->id }}" @if($loopingages->id == Auth::user()->age_group) selected="selected" @endif>{{ $loopingages->title }}</option>
                           @endforeach
                           @endif
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Income</label>
                        <select class="form-control border-input" id="income" name="income" value="{{ old('country') }}">
                           <option value="">Choose Income</option>
                           @if(!is_null($income))
                           @foreach($income as $income)  
                           <option value="{{ $income->id }}" @if($income->id == Auth::user()->income) selected="selected" @endif>{{ $income->title }}</option>
                           @endforeach
                           @endif
                        </select>
                     </div>
                  </div>                  
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Education</label>
                        <select class="form-control border-input" id="education" name="education">
                           <option value="">Choose Education</option>
                           @if(!is_null($education))
                           @foreach($education as $education)  
                           <option value="{{ $education->id }}" @if($education->id == Auth::user()->education) selected="selected" @endif>{{ $education->title }}</option>
                           @endforeach
                           @endif
                        </select>
                     </div>
                  </div>
               </div>               
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control border-input" placeholder="Address" name="address" value="{{ Auth::user()->address }}">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Profile Image</label>
                        <input type="file" id="avatar" name="avatar" class="form-control border-input" onchange="ValidateSingleInput(this);">
                        <img id="image_src" class="img-circle" src="/uploads/avatars/{{ Auth::user()->avatar }}" style="height: 45px; width: 45px;">                                                
                     </div>
                  </div>
               </div>
               <div class="text-center">
                  <button id="user_profile_btn" type="submit" class="btn btn-info btn-fill btn-wd">Update</button>
               </div>
               <div class="clearfix"></div>
            </form>
         </div>
      </div>
   </div>
</div>

	</div>
</div>
    </div>

@endsection

@section('custom_scripts')

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#agegroup').select2({
        placeholder: 'Choose Age Group'
      });      
      $('#income').select2({
        placeholder: 'Choose Income'
      });      
      $('#education').select2({
        placeholder: 'Choose Education'
      });
  });
  </script>

@endsection