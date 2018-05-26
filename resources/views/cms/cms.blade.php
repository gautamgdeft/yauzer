@extends('layouts.user')

@section('content')


<div class="youzer-details">
<div class="container">
<div class="youzer-details-container">
<div class="youzer-details-heading">


 
   {!! str_replace(['{signup_btn}', '{ownerlogin_btn}', '{userlogin_btn}'], ['<a href="/register" class="editor-btn">Signup</a>', '<a href="/business-login" class="editor-btn">Log in for Business</a>', '<a href="/login" class="editor-btn">Login</a>'], $page->description) !!}

</div>
</div>
</div>
</div>

@endsection