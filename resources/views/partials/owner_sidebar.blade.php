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
            <li class="{{ (\Request::route()->getName() == 'owner.dashboard') ? 'active' : '' }}">
                <a href="{{ route('owner.dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="{{ (\Request::route()->getName() == 'owner.edit_biz_basic_info') ? 'active' : '' }}">
                <a href="{{ route('owner.edit_biz_basic_info') }}">
                    <i class="fa fa-briefcase"></i> <span>Biz Basic Information</span>
                </a>
            </li>               

            <li class="{{ (\Request::route()->getName() == 'owner.payment_information') ? 'active' : '' }}">
                <a href="{{ route('owner.payment_information') }}">
                    <i class="fa fa-credit-card"></i> <span>Payment Information</span>
                </a>
            </li>               

            <li class="{{ (\Request::route()->getName() == 'owner.edit_biz_additional_info') ? 'active' : '' }}">
                <a href="{{ route('owner.edit_biz_additional_info') }}">
                    <i class="fa fa-briefcase"></i> <span>Additional Biz Information</span>
                </a>
            </li>               

            <li class="{{ (\Request::route()->getName() == 'owner.pictures_videos' || \Request::route()->getName() == 'owner.new_picture_form') ? 'active' : '' }}">
                <a href="{{ route('owner.pictures_videos') }}">
                    <i class="fa fa-picture-o"></i> <span>Pictures & Videos</span>
                </a>
            </li>            

            <li class="{{ (\Request::route()->getName() == 'owner.biz_description' || \Request::route()->getName() == 'owner.show_business_description_form') ? 'active' : '' }}">
                <a href="{{ route('owner.biz_description') }}">
                    <i class="fa fa-briefcase"></i> <span>Biz Description</span>
                </a>
            </li>             

            <li class="{{ (\Request::route()->getName() == 'owner.biz_hours') ? 'active' : '' }}">
                <a href="{{ route('owner.biz_hours') }}">
                    <i class="fa fa-clock-o"></i> <span>Biz Hours</span>
                </a>
            </li>             

            <li class="{{ (\Request::route()->getName() == 'owner.biz_specialties') ? 'active' : '' }}">
                <a href="{{ route('owner.biz_specialties') }}">
                    <i class="fa fa-building-o"></i> <span>Biz Specialties</span>
                </a>
            </li>            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>