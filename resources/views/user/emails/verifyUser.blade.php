<body>

	<h2>Welcome to Yauzer {{$user->name}}</h2>
	<br/>
	@if($user->roles->first()->name == 'user')	
	 You’re one step closer to start Yauzing your favorite places.
	@else
	 You’re one step closer to get your business ready for Yauzing.
	@endif
	<br/>
	Let’s verify your account by clicking the link below and let the fun begin.
	<br/>
	<a href="{{url('user/verify', $user->token)}}">Verify Email</a>
	<br/>
	<br/>
	The Yauzer team.
	</body>

