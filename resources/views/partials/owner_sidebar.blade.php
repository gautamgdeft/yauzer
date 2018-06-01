<style type="text/css">
    
a.disabled {
   pointer-events: none;
   cursor: default;
}

.skin-black .sidebar > .sidebar-menu > li > a{
   
}
.skin-black .sidebar > .sidebar-menu > li.deactivated > a:hover{
     background: #ccc;
    color: #fff;
}

</style>

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
                <a href="{{ route('owner.edit_biz_basic_info') }}" >
                    <i class="fa fa-briefcase"></i> <span>Biz Basic Information</span>
                </a>
            </li>               

            <li class="{{ (\Request::route()->getName() == 'owner.payment_information') ? 'active' : '' }} @if(Auth::User()->business->yauzers->count() < $plans->yauzer) deactivated @endif">
                <a href="{{ Auth::User()->business->yauzers->count() < $plans->yauzer? route('owner.unautorize_access') : route('owner.payment_information') }}">
                    <i class="fa fa-credit-card"></i> <span>Payment Information</span>
                </a>
            </li>            

            <li class="{{ (\Request::route()->getName() == 'owner.market_get_yauzers') ? 'active' : '' }} @if(Auth::User()->business->yauzers->count() < $plans->yauzer) deactivated @endif">
                <a href="{{ Auth::User()->business->yauzers->count() < $plans->yauzer? route('owner.unautorize_access') : route('owner.market_get_yauzers') }}">
                    <i class="fa fa-envelope-o"></i> <span>Market it! Get more Yauzers</span>
                </a>
            </li>               
             
            <li class="{{ (\Request::route()->getName() == 'owner.edit_biz_additional_info') ? 'active' : '' }} @if(Auth::User()->business->premium_status == false) deactivated @endif">
                <a href="{{ (Auth::User()->business->premium_status == false)? route('owner.unautorize_access') : route('owner.edit_biz_additional_info') }}" class="@if(Auth::User()->business->premium_status == false) deactivated @endif">
                    <i class="fa fa-briefcase"></i> <span>Additional Biz Information</span>
                </a>
            </li>               

            <li class="{{ (\Request::route()->getName() == 'owner.pictures_videos' || \Request::route()->getName() == 'owner.new_picture_form') ? 'active' : '' }} @if(Auth::User()->business->premium_status == false) deactivated @endif">
                <a href="{{ (Auth::User()->business->premium_status == false)? route('owner.unautorize_access') : route('owner.pictures_videos') }}" class="@if(Auth::User()->business->premium_status == false) deactivated @endif">
                    <i class="fa fa-picture-o"></i> <span>Pictures & Videos</span>
                </a>
            </li>            

            <li class="{{ (\Request::route()->getName() == 'owner.biz_description' || \Request::route()->getName() == 'owner.show_business_description_form') ? 'active' : '' }} @if(Auth::User()->business->premium_status == false) deactivated @endif">
                <a href="{{ (Auth::User()->business->premium_status == false)? route('owner.unautorize_access') : route('owner.biz_description') }}" class="@if(Auth::User()->business->premium_status == false) deactivated @endif">
                    <i class="fa fa-briefcase"></i> <span>Biz Description</span>
                </a>
            </li>             

            <li class="{{ (\Request::route()->getName() == 'owner.biz_hours') ? 'active' : '' }} @if(Auth::User()->business->premium_status == false) deactivated @endif">
                <a href="{{ (Auth::User()->business->premium_status == false)? route('owner.unautorize_access') : route('owner.biz_hours') }}" class="@if(Auth::User()->business->premium_status == false) deactivated @endif">
                    <i class="fa fa-clock-o"></i> <span>Biz Hours</span>
                </a>
            </li>             

            <li class="{{ (\Request::route()->getName() == 'owner.biz_specialties' || \Request::route()->getName() == 'owner.new_speciality_form' || \Request::route()->getName() == 'owner.edit_speciality') ? 'active' : '' }} @if(Auth::User()->business->premium_status == false) deactivated @endif">
                <a href="{{ (Auth::User()->business->premium_status == false)? route('owner.biz_specialties') : route('owner.biz_specialties') }}" class="@if(Auth::User()->business->premium_status == false)  @endif">
                    <i class="fa fa-building-o"></i> <span>Biz Specialties</span>

                </a>
            </li>              

            <li class="{{ (\Request::route()->getName() == 'owner.biz_more_info') ? 'active' : '' }} @if(Auth::User()->business->premium_status == false) deactivated @endif">
                <a href="{{ (Auth::User()->business->premium_status == false)? route('owner.unautorize_access') : route('owner.biz_more_info') }}" class="@if(Auth::User()->business->premium_status == false) deactivated @endif">
                    <i class="fa fa-info"></i> <span>More Info</span>
                </a>
            </li>                

            <li class="{{ (\Request::route()->getName() == 'owner.discounts') ? 'active' : '' }} @if(Auth::User()->business->premium_status == false) deactivated @endif">
                <a href="{{ (Auth::User()->business->premium_status == false)? route('owner.unautorize_access') :route('owner.discounts') }}" class="@if(Auth::User()->business->premium_status == false) deactivated @endif">
                    <i class="fa fa-money"></i> <span>My Biz Discounts</span>
                </a>
            </li>              

{{--             <li class="{{ (\Request::route()->getName() == 'owner.yauzers') ? 'active' : '' }} @if(Auth::User()->business->premium_status == false) deactivated @endif">
                <a href="{{ (Auth::User()->business->premium_status == false)? route('owner.unautorize_access') : route('owner.yauzers') }}" class="@if(Auth::User()->business->premium_status == false) deactivated @endif">
                    <i class="fa fa-comment"></i> <span>Yauzers</span>
                </a>
            </li>    --}}          

             <li class="{{ (\Request::route()->getName() == 'owner.yauzers') ? 'active' : '' }}">
                <a href="{{ route('owner.yauzers') }}">
                    <i class="fa fa-comment"></i> <span>Yauzers</span>
                </a>
            </li>            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>