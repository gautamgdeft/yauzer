@extends('layouts.owner')

@section('content')


<!--Share Business Info Popup-->
<!-- Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-share-alt"></i>{{ session('success') }}</br>Share your Business <b>{{ Auth::user()->business->name }}</b> on social media</h4>
      </div>
      <div class="modal-body">
        <p>
          <a target="_blank" title="Facebook" href="{{ Share::load(route('user.business_detail',['slug' => Auth::user()->business->slug]),Auth::user()->business->name)->facebook() }}"><img src="{{ asset('images/icon-fb.png') }}" alt="Facebook"/></a>

          <a target="_blank" title="Twitter" href="{{ Share::load(route('user.business_detail',['slug' => Auth::user()->business->slug]), Auth::user()->business->name)->twitter() }}"><img src="{{ asset('images/icon-twitter.png') }}" alt="Twitter"/></a> 

          <a target="_blank" title="Google+" href="{{ Share::load(route('user.business_detail',['slug' => Auth::user()->business->slug]), Auth::user()->business->name)->gplus() }}"><img src="{{ asset('images/icon-gplus.png') }}" alt="Google Plus"/></a> 

          <a target="_blank" title="Linkedin" href="{{ Share::load(route('user.business_detail',['slug' => Auth::user()->business->slug]), Auth::user()->business->name)->linkedin() }}"><img style="height: 55px; width:55px;" src="{{ asset('images/linkedin-icon.png') }}" alt="Linkedin"/></a>

          <a target="_blank" title="Pinterest" href="{{ Share::load(route('user.business_detail',['slug' => Auth::user()->business->slug]), Auth::user()->business->name)->pinterest() }}"><img style="height: 55px; width:55px;" src="{{ asset('images/icon-Pinterest.png') }}" alt="Pinterest"/></a> 
        </p>
                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Dashboard
         <small>{{ Auth::user()->business->name }}</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Dashboard</li>
      </ol>
   </section>

    <div id="msgs">
     @if(session('success'))
     <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif

     @if(session('error'))
      <div class="alert alert-danger">
      {{ session('error') }}
      </div>
     @endif    
     
    </div>

   <section class="owner-dashboard">
  <div class="container">
    <div class="row">
      <div class="col-sm-7">
        <div class="premium-listing-text">
          <img src="/uploads/siteCMSAvatars/{{ $ownerHeadercms->default_bg_image }}">
          {!! $ownerHeadercms->description_ckeditor !!}
        </div>
        <div class="col-sm-6 padding-left-none">
          <div class="listing-container">
            <div class="listing-heading">
              <h2>{{ $ownerBasicListingcms->first_section }}</h2><a href="{{ Auth::User()->business->yauzers->count() < $plans->yauzer? route('owner.unautorize_access') : route('owner.payment_information') }}"><i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <div class="listing-content">
              {!! $ownerBasicListingcms->description_ckeditor !!}
            </div>
          </div>
          <div class="premium-charges">
            <div class="premium-charges-left">
            <img src="/uploads/siteCMSAvatars/{{ $ownerPricingStructurecms->default_bg_image }}">
            <div class="premium-charges-text">
              {!! $ownerPricingStructurecms->description_ckeditor !!} 
            </div>
          </div>
          <div class="premium-charges-right">
            <a href="{{ Auth::User()->business->yauzers->count() < $plans->yauzer? route('owner.unautorize_access') : route('owner.payment_information') }}"><i class="fa fa-arrow-circle-right"></i></a>
          </div>
          </div>
        </div>
        <div class="col-sm-6 padding-right-none">
        <div class="listing-container premium-listing">
            <div class="listing-heading">
              <h2>{{ $ownerPremiumListingcms->first_section }}</h2><a href="{{ Auth::User()->business->yauzers->count() < $plans->yauzer? route('owner.unautorize_access') : route('owner.payment_information') }}"><i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <div class="listing-content">
              {!! $ownerPremiumListingcms->description_ckeditor !!}
            </div>
          </div>
      </div>
      </div>
      <div class="col-sm-3">
        <div class="basic-listing">
         @if(Auth::user()->business->premium_status == true) 
          <h2>Premium Listing</h2>
          <p>You have a Premium Listing, you’re all set. Yauz on!</p>          
         @else
          <h2>Basic listing</h2>
          <p>You have a Basic Listing. Unlock the power of Premium for only pennies a day.</p>
         @endif
        </div>
        
        <h4>Yauzer Stats</h4>
        <div class="small-box bg-yellow">
           <div class="inner">
              <h3>
                
                 {{ Auth::user()->business->yauzers->count() }}
              </h3>
              <p>
                 Yauzers
              </p>
           </div>
           <div class="icon">
              <i class="fa fa-user"></i>
           </div>
           <a href="{{ route('owner.yauzers') }}" class="small-box-footer">
           More info <i class="fa fa-arrow-circle-right"></i>
           </a>
        </div>  
        <div class="list-rating">
          <div class="rating-customer">
           @if(@sizeof(Auth::user()->business->yauzers)) 
            <div class="rating-customer-image"> 
             <img src="/uploads/avatars/{{ Auth::user()->business->yauzers->last()->user->avatar }}" class="img-circle" alt="User Image">
            </div>
            <div class="rating-customer-name">
              <h2>{{ @sizeof(Auth::user()->business->yauzers)? Auth::user()->business->yauzers->last()->user->name : '' }}</h2>
            </div>            
            <div class="star-rating">
              <input id="input-21e" value="{{ Auth::user()->business->yauzers->last()->rating }}" type="text" class="rating" data-min=0 data-max=5 data-step=0.5 data-size="xs" title="" disabled="disabled">
            </div>
           @endif            
            <p class="rating-description">{{ @sizeof(Auth::user()->business->yauzers)? Auth::user()->business->yauzers->last()->yauzer : '' }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
   </section>




















   <!-- /.content -->
</aside>
<!-- /.right-side -->

@endsection


@section('custom_scripts')

 <script type="text/javascript">

 @if(Session::has('popupMessage'))  
   $(function () {
    $('#shareModal').modal('show');
   });
 @endif  
  

 </script>

@endsection