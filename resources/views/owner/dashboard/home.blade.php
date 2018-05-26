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


             
   <!-- Main content -->
   <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
         <!-- ./col -->
         <div class="col-lg-3 col-xs-6">

          <img src="{{ asset('images/Yauza-Yauza-Welcome-to-Yauzer.png') }}">
          <p>Marketing is critical to your business and you cannot have too much exposure.</p>
          <p>Unlock your PREMIUN LISTING and let the Word of Mouth advertising work for you.</p>
            <!-- small box -->
            <div class="small-box bg-yellow">
               <div class="inner">
                  <h3>
                     {{-- @if(sizeof($yauzers['yauzers'])) {{ $yauzers['yauzers']->count() }} @else 0 @endif --}}
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
         </div>
         <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- top row -->
      <div class="row">
         <div class="col-xs-12 connectedSortable">
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->

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