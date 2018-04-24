      <footer class="dr-footer">
        <div class="top-footer"> 
          <div class="container"> 
            <div class="row"> 
             <div class="col-md-3 col-sm-12  col-xs-12"> 
              <div class="footer-logo-outr">
                <a href="index.html" class="footer-logo"> <img src="{{ asset('images/logo.png') }}" alt=""/> </a>
              </div>
              <div class="get-in-touch-list">
                <ul> 

                  <li> <i class="fa fa-envelope"> </i><a href="javascript:;"> Contact Us </a>
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
              <li> 
               <div class="left-img">
                <figure> <img src="{{ asset('images/recent-blog-img1.png') }}" alt=""/> </figure>
              </div>
              <div class="right-content"> 
               <p class="running-text">Within the construction industry as their overdraft </p> 
               <p class="time-sec"> <img src="{{ asset('images/watch-icon.png') }}" alt=""/> January 22, 2016</p>
             </div>
           </li>
           <li> 
             <div class="left-img">
              <figure> <img src="{{ asset('images/recent-blog-img1.png') }}" alt=""/> </figure>
            </div>
            <div class="right-content"> 
             <p class="running-text">Within the construction industry as their overdraft </p> 
             <p class="time-sec"> <img src="{{ asset('images/watch-icon.png') }}" alt=""/> January 22, 2016</p>
           </div>
         </li>
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