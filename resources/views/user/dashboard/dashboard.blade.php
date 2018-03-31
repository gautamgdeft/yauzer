@extends('layouts.user')

@section('content')





<div class="blog-form-wrapper create-listing list-new">
<div class="container">
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="/uploads/avatars/{{ Auth::user()->avatar }}" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						{{ Auth::user()->name }}
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					{{-- <button type="button" class="btn btn-success btn-sm">Follow</button>
					<button type="button" class="btn btn-danger btn-sm">Message</button> --}}
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="active">
							<a href="{{ route('user.dashboard') }}">
							<i class="glyphicon glyphicon-home"></i>
							Profile </a>
						</li>
{{-- 						<li>
							<a href="#">
							<i class="glyphicon glyphicon-user"></i>
							Account Settings </a>
						</li>
						<li>
							<a href="#" target="_blank">
							<i class="glyphicon glyphicon-ok"></i>
							Tasks </a>
						</li>
						<li>
							<a href="#">
							<i class="glyphicon glyphicon-flag"></i>
							Help </a>
						</li> --}}
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            <div class="profile-content">
          <div id="msgs">
           @if(session('success'))
           <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif
          </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form name="user_profile_form" method="POST" action="{{ route('user.update_profile') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control border-input" placeholder="First Name" name="firstname" value="{{ strtok(Auth::user()->name, ' ') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control border-input" placeholder="Last Name" name="lastname" value="{{ strstr(Auth::user()->name, ' ') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="text" class="form-control border-input" disabled="" placeholder="Email Address" name="email" value="{{ Auth::user()->email }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control border-input" placeholder="Phone number" name="phone_number" value="{{ Auth::user()->phone_number }}" required>
                                            </div>
                                        </div>
                                    </div>                                           

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control border-input" placeholder="City" name="city" value="{{ Auth::user()->city }}" required>
                                            </div>
                                        </div>                                        

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>State</label>
                                                <input type="text" class="form-control border-input" placeholder="State" name="state" value="{{ Auth::user()->state }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                    	
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select class="form-control border-input" id="country" name="country" value="{{ old('country') }}" required>
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
                                                <input type="number" class="form-control border-input" placeholder="ZIP Code" name="zipcode" value="{{ Auth::user()->zipcode }}" required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control border-input" placeholder="Address" name="address" value="{{ Auth::user()->address }}" required>
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
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Update Profile</button>
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
    </div>












<style type="text/css">
	
/* Profile container */
.profile {
  margin: 20px 0;
}

/* Profile sidebar */
.profile-sidebar {
  padding: 20px 0 10px 0;
  background: #fff;
}

.profile-userpic img {
  float: none;
  margin: 0 auto;
  width: 50%;
  height: 50%;
  -webkit-border-radius: 50% !important;
  -moz-border-radius: 50% !important;
  border-radius: 50% !important;
}

.profile-usertitle {
  text-align: center;
  margin-top: 20px;
}

.profile-usertitle-name {
  color: #5a7391;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 7px;
}

.profile-usertitle-job {
  text-transform: uppercase;
  color: #5b9bd1;
  font-size: 12px;
  font-weight: 600;
  margin-bottom: 15px;
}

.profile-userbuttons {
  text-align: center;
  margin-top: 10px;
}

.profile-userbuttons .btn {
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 600;
  padding: 6px 15px;
  margin-right: 5px;
}

.profile-userbuttons .btn:last-child {
  margin-right: 0px;
}
    
.profile-usermenu {
  margin-top: 30px;
}

.profile-usermenu ul li {
  border-bottom: 1px solid #f0f4f7;
}

.profile-usermenu ul li:last-child {
  border-bottom: none;
}

.profile-usermenu ul li a {
  color: #93a3b5;
  font-size: 14px;
  font-weight: 400;
}

.profile-usermenu ul li a i {
  margin-right: 8px;
  font-size: 14px;
}

.profile-usermenu ul li a:hover {
  background-color: #fafcfd;
  color: #5b9bd1;
}

.profile-usermenu ul li.active {
  border-bottom: none;
}

.profile-usermenu ul li.active a {
  color: #5b9bd1;
  background-color: #f6f9fb;
  border-left: 2px solid #5b9bd1;
  margin-left: -2px;
}

/* Profile Content */
.profile-content {
  padding: 20px;
  background: #fff;
  min-height: 460px;
}


</style>






@endsection