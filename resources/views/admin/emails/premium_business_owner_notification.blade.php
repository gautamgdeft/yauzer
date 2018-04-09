<!DOCTYPE html>
<html>
<head>
    <title>Premium Business Notification</title>
</head>
 
<body>
	Hie {{ $business->user->name }} <br/>
	Business {{ $business->name }} has collected 15 yauzers and now qualifies for premium listing.
<br/>
<a href="{{ route('admin.show_business',['slug' => $business->slug]) }}">View Business</a>
</body>
 
</html>