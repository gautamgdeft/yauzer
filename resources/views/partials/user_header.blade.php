<!-- header section -->
<header class="dr-header">
   <div class="top-header">
      <div class="container">
         <div class="row">
            <div class="col-sm-4 col-xs-12  logo-outr">
               <a href="{{ route('home.welcome') }}" class="logo"> <img src="{{ asset('images/logo.png') }}" alt=""/> </a>
               <div class="visible-xs">
                  <form class="navbar-form navbar-right">
                     <div class="search-main">
                        <div class="search-icons"> <a class="search-btn active" href="javascript:void(0)"><i class="fa fa-search" aria-hidden="true"></i></a> <a class="search-close-btn" href="javascript:void(0)"><i class="fa fa-times" aria-hidden="true"></i></a> </div>
                        <div class="search-field">
                           <div class="search-field-inner">
                              <input class="form-control" name="name" placeholder="Type here to search..." type="text"> 
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="col-sm-4 col-xs-12 pull-left">
               <ul class="top-social-sec">
                  <li><a href="javascript:;"> <i class="fa fa-facebook" aria-hidden="true"></i> </a> </li>
                  <li><a href="javascript:;"> <i class="fa fa-google-plus" aria-hidden="true"></i> </a> </li>
                  <li><a href="javascript:;"> <i class="fa fa-twitter" aria-hidden="true"></i> </a> </li>
                  <li><a href="javascript:;"> <i class="fa fa-whatsapp" aria-hidden="true"></i> </a> </li>
                  <li><a href="javascript:;"> <i class="fa fa-skype" aria-hidden="true"></i> </a> </li>
               </ul>
            </div>
            <div class="col-sm-4 col-xs-12 pull-right login-sec">
               <div class="wanna-text"><a href="javascript:;"> Wanna Yauz?  </a></div>
               <div class="top-nav-link text-right">
                  <ul>

                     @guest
                     <li><a href="{{ route('login') }}"> Login  </a></li>
                     <li><a href="{{ route('register') }}">  Signup </a></li>
                     @else
                      <li class="dropdown">
                          <img id="image_src" class="img-circle" src="/uploads/avatars/{{ Auth::user()->avatar }}" style="height: 45px; width: 45px;">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                              {{ Auth::user()->name }} <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu">
                              <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                              <li><a href="{{ route('user.yauzer_business') }}">Yauzer a Business </a></li>
                              <li>
                                  <a href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                      Logout
                                  </a>

                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      {{ csrf_field() }}
                                  </form>
                              </li>
                          </ul>
                      </li>
                     @endguest 

                  </ul>
               </div>
               @guest
                <div class="log-business"><a href="{{ route('login') }}">Log in for Business</a> </div>
               @endguest
            </div>
         </div>
      </div>
   </div>
   <nav class="navbar">
      <div class="menu">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>                        
               </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
               <ul class="nav navbar-nav">
                  <li class="active"><a href="javascript:void(0)">Find a Business</a></li>
                  <li><a href="javascript:void(0)">What is Yauzer </a></li>
                  <li><a href="javascript:void(0)">Yauzer for Business</a></li>
                  <li><a href="javascript:void(0)">Yauzer a Business</a></li>
               </ul>
            </div>
         </div>
      </div>
   </nav>
</header>

<!-- header-section-ends -->