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
						<a target="_blank" href="{{ Share::load('', 'Yauza, Yauza, Yauza! I’m on https://Yauzer.com and sharing my faves. Join me!')->facebook() }}"><i data-toggle="tooltip" title="Share on Facebook" data-placement="bottom" class="fa fa-facebook" aria-hidden="true"></i></a>                        
                        <a target="_blank" href="{{ Share::load('', 'Yauza, Yauza, Yauza! I’m on https://Yauzer.com and sharing my faves. Join me!')->twitter() }}"><i data-toggle="tooltip" title="Share on Twitter" data-placement="bottom" class="fa fa-twitter" aria-hidden="true"></i></a>                        
                        <a target="_blank" href="{{ Share::load('', 'Yauza, Yauza, Yauza! I’m on https://Yauzer.com and sharing my faves. Join me!')->linkedin() }}"><i data-toggle="tooltip" title="Share on Linkedin" data-placement="bottom" class="fa fa-linkedin" aria-hidden="true"></i></a>                        							
							<p>The more you share, the more chances to win in our quarterly drawing, keep coming back. Yauz on!</p>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>