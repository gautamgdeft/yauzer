      <footer class="dr-footer">
        <div class="top-footer"> 
          <div class="container"> 
            <div class="row"> 
             <div class="col-md-3 col-sm-12  col-xs-12"> 
              <div class="footer-logo-outr">
                <a href="{{ route('home.welcome') }}" class="footer-logo"> <img src="{{ asset('images/logo.png') }}" alt=""/> </a>
              </div>
              <div class="get-in-touch-list">
                <ul> 

                  <li> <i class="fa fa-envelope"> </i><a href="{{ route('contactus') }}"> Contact Us </a>
                  </li>
                  <li> <i class="fa fa-map-marker"> </i> <!--Visit Us--><a href="{{ route('user.yauzer_business') }}">Yauzer a Business</a></li>
                  
                </ul>
              </div>
            </div>

            <div class="col-md-3 col-sm-4 col-xs-12"> 
             <div class="footer-links"> 
               <h4>Yauzer Links </h4>
               <ul>
                @if ((Auth::user() && Auth::user()->roles->first()->name == 'owner')) 
                 <li> <a href="{{ route('user.home') }}"> Yauzer for Business</a> </li>
                @else
                 <li><a href="{{ route('owner.login') }}">Yauzer for Business</a></li>
                @endif

                @if(@sizeof($footerMenus))
                @foreach($footerMenus as $loopingFooterMenu)
                 <li> <a href="{{ $loopingFooterMenu->url }}">  {{ $loopingFooterMenu->name }}</a> </li>
                @endforeach
                @endif
              </ul>
            </div>
          </div>

          <div class="col-md-3 col-sm-4 col-xs-12 paddingleft0"> 
           <div class="footer-links blogs"> 
             <h4>Recent Blogs </h4>
             <ul> 
              @if(@sizeof($blogs))
              @foreach($blogs as $key => $loopingBlogs)
              @if($key <= 2) 
           <li> 
            <a href="{{ route('showsingleBlog',['slug' => $loopingBlogs->slug]) }}">
               <div class="left-img">
                <figure> <img src="/uploads/blogavatars/{{ $loopingBlogs->avatar }}" alt="img"> </figure>
              </div>
              <div class="right-content"> 
               <p class="running-text">{{ $loopingBlogs->title }}</p> 
               <p class="time-sec"> <img src="{{ asset('images/watch-icon.png') }}" alt=""/> {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $loopingBlogs->created_at)->format('F') }} {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $loopingBlogs->created_at)->day }}, {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $loopingBlogs->created_at)->year }}</p>
             </div>
            </a> 
           </li>
           @endif
           @endforeach
           @endif
       </ul>
     </div>
   </div>

   <div class="col-md-3 col-sm-4 col-xs-12"> 
     <div class="footer-links address"> 
       <h4>Get Yauzer Social </h4>
       <div class="footer-social-icons">
         <ul>
           <li><a href="javascript:void(0)"><i class="fa fa-facebook-f"></i></a></li>
           <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
           <li><a href="javascript:void(0)"><i class="fa fa-instagram"></i></a></li>
         </ul>
       </div>
     </div>
   </div>
 </div>
</div>
</div>

<div class="bottom-footer">
  <div class="container"> 
    <div class="row"> 
     <div class="col-sm-12 col-xs-12">  
      <p>© COPYRIGHT 2018 YAUZER.COM ALL RIGHTS RESERVED <p>
      </div>
    </div>
  </div>
</div>

</footer>