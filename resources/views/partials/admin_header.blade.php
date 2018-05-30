<header class="header">
   <a href="{{ route('admin.dashboard') }}" class="logo">
      <!-- Add the class icon to your logo image or logo icon to add the margining -->
      <img src="{{ asset('img/logo.png') }}" alt="user image"/>
   </a>
   <!-- Header Navbar: style can be found in header.less -->
   <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only test">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </a>
      <div class="navbar-right">
         <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <i class="glyphicon glyphicon-user"></i>
               <span>{{ Auth::user()->name }} <i class="caret"></i></span>
               </a>
               <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header bg-light-blue">
                     <img src="/uploads/avatars/{{ Auth::user()->avatar }}" class="img-circle" alt="User Image" />
                     <p>
                        {{ Auth::user()->name }}
                        <small>Site Admin</small>
                     </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                     <a href="{{ route('admin.profile') }}" class="btn btn-default btn-flat">Profile</a>
                  </li>
                  <li>
                     <a href="{{ route('admin.showChangePasswordForm') }}" class="btn btn-default btn-flat">Change Password</a>
                  </li>
                  <li>
                     <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">Sign out</a>
                  </li>
                  </li>
               </ul>
            </li>
         </ul>
      </div>
   </nav>
</header>