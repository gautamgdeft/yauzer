<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/uploads/avatars/{{ Auth::user()->avatar }}" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Hello, {{ Auth::user()->name }}</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="{{ (\Request::route()->getName() == 'admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="{{ (\Request::route()->getName() == 'admin.users') ? 'active' : '' }}">
                <a href="{{ route('admin.users') }}">
                    <i class="fa fa-user"></i> <span>Customer Management</span>
                </a>
            </li>

            <li class="{{ (\Request::route()->getName() == 'admin.owners') ? 'active' : '' }}">
                <a href="{{ route('admin.owners') }}">
                    <i class="fa fa-user"></i> <span>Owner Management</span>
                </a>
            </li>

            <li class="{{ (\Request::route()->getName() == 'admin.business_category_listing') ? 'active' : '' }}">
                <a href="{{ route('admin.business_category_listing') }}">
                    <i class="fa fa-user"></i> <span>Business Categories</span>
                </a>
            </li>

            <li class="{{ (\Request::route()->getName() == 'admin.business_listing') ? 'active' : '' }}">
                <a href="{{ route('admin.business_listing') }}">
                    <i class="fa fa-suitcase"></i> <span>Business Listings</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Content Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.pages') }}"><i class="fa fa-angle-double-right"></i> Manage Pages</a></li>
                    <li><a href="{{ route('admin.sliderimages') }}"><i class="fa fa-angle-double-right"></i> Manage Slider Images</a></li>

                    <li class="treeview">
                      <a href="#">
                         <i class="fa fa-angle-double-right"></i> 
                         <span> Manage Menus </span>
                      </a>   
                     <ul class="treeview-menu">
                        <li><a href="{{ route('admin.headermenus') }}"><i class="fa fa-angle-double-right"></i> Manage Header Menu</a></li>
                        <li><a href="{{ route('admin.footermenus') }}"><i class="fa fa-angle-double-right"></i> Manage Footer Menu</a></li>
                     </ul>                    
                    </li>
                    <li><a href="{{ route('admin.faqs') }}"><i class="fa fa-angle-double-right"></i> Manage FAQ</a></li>

                </ul>
            </li>

            <li class="{{ (\Request::route()->getName() == 'admin.report_management') ? 'active' : '' }}">
                <a href="{{ route('admin.report_management') }}">
                    <i class="fa fa-building-o"></i> <span>Report Management</span>
                </a>
            </li>
                        
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-envelope"></i>
                    <span>Contact US</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.contactListing') }}"><i class="fa fa-angle-double-right"></i> Contact Listing</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>