<!DOCTYPE html>
<html>
<head>
    <title>New Business Notification</title>
</head>
 
<body>
	New Business {{ $business->name }} has been added by the user {{ $business->business_added_by->name }} with email {{ $business->business_added_by->email }}. Please review the business.
<br/>
<a href="{{ route('admin.show_business',['slug' => $business->slug]) }}">View Business</a>
</body>
 
</html>