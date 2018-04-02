<!DOCTYPE html>
<html>
<head>
    <title>Business Status Email</title>
</head>
 
<body>
	  Business {{ $businessListing->name }} have been {{ ($businessListing->status == true) ? 'Approved' : 'Rejected' }} by the Admin. @if($businessListing->status == false) Try with another business. @endif
<br/>
</body>
 
</html>