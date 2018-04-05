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
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>