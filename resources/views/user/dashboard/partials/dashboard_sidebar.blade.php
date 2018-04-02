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
						<li class="{{ (\Request::route()->getName() == 'user.dashboard') ? 'active' : '' }}">
							<a href="{{ route('user.dashboard') }}">
							<i class="glyphicon glyphicon-user"></i>
							Profile </a>
						</li>
						<li class="{{ (\Request::route()->getName() == 'user.yauzers') ? 'active' : '' }}">
							<a href="{{ route('user.yauzers') }}">
              <i class="fa fa-star" aria-hidden="true"></i>
							Yauzers </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>