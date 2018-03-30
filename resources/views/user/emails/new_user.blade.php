<!DOCTYPE html>
<html>
<head>
    <title>New User Registeration</title>
</head>
 
<body>
	New {{ $user->roles->first()->name }} with email-id {{ $user->email }} has registered successfully.
<br/>
</body>
 
</html>