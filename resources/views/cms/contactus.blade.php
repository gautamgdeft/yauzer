@extends('layouts.user')

@section('content')


<div id="msgs">
 @if(session('success'))
 <div class="alert alert-success">
  {{ session('success') }}
</div>
@endif
</div>

<div class="contact-us-wrapper">
<div class="container">
<div class="row">
	<div class="col-sm-12">
    <div class="yauzer-contact-heading">
   <div class="text-center heading-text">
      <hr>
      <h2 class="sec-title pos-rel"> Contact  <span>Us</span></h2>
   </div>
</div>
	</div>
<div class="col-sm-4">
	<div class="contactus-left">
		<div class="contact-list-container">
      <div class="contactus-icons">
        <i class="fa fa-phone"></i>
      </div>
      <div class="contactus-details">
       <p>888-686-2849</p>
      </div>
  </div>
  <div class="contact-list-container">
      <div class="contactus-icons">
        <i class="fa fa-envelope"></i>
      </div>
      <div class="contactus-details">
       <p>info@yauzer.com</p>
      </div>
  </div>
  <div class="contact-list-container">
      <div class="contactus-icons">
        <i class="fa fa-map-marker"></i>
      </div>
      <div class="contactus-details">
       <p>P.O. Box 827871 South Florida, FL 33082</p>
      </div>
  </div>
	</div>
</div>
<div class="col-sm-8">
<div class="profile-content contact-page">
      <div class="card">
         <div class="content">
            <form id="contact_form" name="contact_form" method="POST" action="{{ route('contactus') }}" enctype="multipart/form-data" novalidate="novalidate">
               {{ csrf_field() }}
               
                  
                     <div class="form-group">
                        <label>Name<span> *</span></label>
                        <input type="text" class="form-control border-input" placeholder="Name" name="name" required="">
                     </div>
                  
                     <div class="form-group">
                        <label>Email Address<span> *</span></label>
                        <input type="text" class="form-control border-input" placeholder="Email Address" name="email" required>
                     </div>                     

                     <div class="form-group" id="yauzer_div">
                        <label>Message<span> *</span></label>
                        <textarea class="form-control" rows="8" name="message" required></textarea>
                     </div>
                  
               

               <div class="text-center">
                  <button id="submit_contact_form" type="submit" class="btn btn-info btn-fill btn-wd">Submit</button>
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