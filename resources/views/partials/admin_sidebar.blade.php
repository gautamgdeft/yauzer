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

            <li class="{{ (\Request::route()->getName() == 'admin.users' || \Request::route()->getName() == 'admin.show_user_form' || \Request::route()->getName() == 'admin.show_edit_form' || \Request::route()->getName() == 'admin.show_customer' || \Request::route()->getName() == 'customer.search') ? 'active' : '' }}">
                <a href="{{ route('admin.users') }}">
                    <i class="fa fa-user"></i> <span>User Management</span>
                </a>
            </li>

            <li class="{{ (\Request::route()->getName() == 'admin.owners' || \Request::route()->getName() == 'admin.show_owner_form' || \Request::route()->getName() == 'admin.edit_owner_form' || \Request::route()->getName() == 'admin.show_owner' || \Request::route()->getName() == 'owner.search') ? 'active' : '' }}">
                <a href="{{ route('admin.owners') }}">
                    <i class="fa fa-user"></i> <span>Owner Management</span>
                </a>
            </li>

            <li class="{{ (\Request::route()->getName() == 'admin.business_category_listing' || \Request::route()->getName() == 'admin.show_category_form' || \Request::route()->getName() == 'admin.edit_category_form' || \Request::route()->getName() == 'admin.show_category' || \Request::route()->getName() == 'admin.show_subcategory' || \Request::route()->getName() == 'admin.show_subcategory_form' || \Request::route()->getName() == 'admin.edit_subcategory_form' || \Request::route()->getName() == 'category.search' || \Request::route()->getName() == 'subcategory.search') ? 'active' : '' }}">
                <a href="{{ route('admin.business_category_listing') }}">
                    <i class="fa fa-user"></i> <span>Business Categories</span>
                </a>
            </li>

            <li class="{{ (\Request::route()->getName() == 'admin.business_listing' || \Request::route()->getName() == 'admin.show_business' || \Request::route()->getName() == 'admin.show_edit_business_form' || \Request::route()->getName() == 'business.search') ? 'active' : '' }}">
                <a  href="{{ route('admin.business_listing') }}">
                    <i class="fa fa-suitcase"></i> <span>Business Listings – Basic</span>
                </a>
            </li>             

            <li class="{{ (\Request::route()->getName() == 'admin.business_listing_premium' || \Request::route()->getName() == 'admin.show_edit_premium_business_form' || \Request::route()->getName() == 'admin.new_picture_form' || \Request::route()->getName() == 'admin.show_business_description_form' || \Request::route()->getName() == 'admin.new_yauzer_form' || \Request::route()->getName() == 'admin.edit_yauzer' || \Request::route()->getName() == 'admin.new_speciality_form' || \Request::route()->getName() == 'admin.edit_speciality' || \Request::route()->getName() == 'admin.show_premium_business' || \Request::route()->getName() == 'premium_business.search' ) ? 'active' : '' }}">
                <a  href="{{ route('admin.business_listing_premium') }}">
                    <i class="fa fa-money"></i> <span>Business Listings – Premium</span>
                </a>
            </li>            

            <li class="{{ (\Request::route()->getName() == 'business.more_info_listing' || \Request::route()->getName() == 'businessinfo.search' || \Request::route()->getName() == 'admin.edit_form' || \Request::route()->getName() == 'business.add_more_info') ? 'active' : '' }}">
                <a href="{{ route('business.more_info_listing') }}">
                    <i class="fa fa-suitcase"></i> <span>Business More Info</span>
                </a>
            </li>

            <li class="treeview {{ (\Request::route()->getName() == 'admin.pages' || \Request::route()->getName() == 'admin.show_page_form' || \Request::route()->getName() == 'admin.edit_page_form' || \Request::route()->getName() == 'admin.sliderimages' || \Request::route()->getName() == 'admin.new_slider_image' || \Request::route()->getName() == 'admin.edit_slider_image' || \Request::route()->getName() == 'admin.headermenus' || \Request::route()->getName() == 'admin.show_header_menu_form' || \Request::route()->getName() == 'admin.edit_header_menu' || \Request::route()->getName() == 'admin.footermenus' || \Request::route()->getName() == 'admin.show_footer_menu_form' || \Request::route()->getName() == 'admin.edit_footer_menu' || \Request::route()->getName() == 'admin.faqs' || \Request::route()->getName() == 'admin.show_faq_form' || \Request::route()->getName() == 'admin.edit_faq_form' || \Request::route()->getName() == 'page.search' || \Request::route()->getName() == 'headermenu.search' || \Request::route()->getName() == 'footermenu.search') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Content Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (\Request::route()->getName() == 'admin.pages' || \Request::route()->getName() == 'admin.show_page_form' || \Request::route()->getName() == 'admin.edit_page_form' || \Request::route()->getName() == 'page.search') ? 'active' : '' }}"><a href="{{ route('admin.pages') }}"><i class="fa fa-angle-double-right"></i> Manage Pages</a></li>

                    <li class="{{ (\Request::route()->getName() == 'admin.sliderimages' || \Request::route()->getName() == 'admin.new_slider_image' || \Request::route()->getName() == 'admin.edit_slider_image') ? 'active' : '' }}"><a href="{{ route('admin.sliderimages') }}"><i class="fa fa-angle-double-right"></i> Manage Slider Images</a></li>

                    <li class="treeview {{ (\Request::route()->getName() == 'admin.headermenus' || \Request::route()->getName() == 'admin.show_header_menu_form' || \Request::route()->getName() == 'admin.edit_header_menu' || \Request::route()->getName() == 'admin.footermenus' || \Request::route()->getName() == 'admin.show_footer_menu_form' || \Request::route()->getName() == 'admin.edit_footer_menu' || \Request::route()->getName() == 'headermenu.search' || \Request::route()->getName() == 'footermenu.search') ? 'active' : '' }}">
                      <a href="#">
                         <i class="fa fa-angle-double-right"></i> 
                         <span> Manage Menus </span>
                      </a>   
                     <ul class="treeview-menu">
                        <li class="{{ (\Request::route()->getName() == 'admin.headermenus' || \Request::route()->getName() == 'admin.show_header_menu_form' || \Request::route()->getName() == 'admin.edit_header_menu' || \Request::route()->getName() == 'headermenu.search') ? 'active' : '' }}"><a href="{{ route('admin.headermenus') }}"><i class="fa fa-angle-double-right"></i> Manage Header Menu</a></li>

                        <li class="{{ (\Request::route()->getName() == 'admin.footermenus' || \Request::route()->getName() == 'admin.show_footer_menu_form' || \Request::route()->getName() == 'admin.edit_footer_menu' || \Request::route()->getName() == 'footermenu.search') ? 'active' : '' }}"><a href="{{ route('admin.footermenus') }}"><i class="fa fa-angle-double-right"></i> Manage Footer Menu</a></li>
                     </ul>                    
                    </li>
                    <li class="{{ (\Request::route()->getName() == 'admin.faqs' || \Request::route()->getName() == 'admin.show_faq_form' || \Request::route()->getName() == 'admin.edit_faq_form') ? 'active' : '' }}"><a href="{{ route('admin.faqs') }}"><i class="fa fa-angle-double-right"></i> Manage FAQ</a></li>

                </ul>
            </li>

            <li class="{{ (\Request::route()->getName() == 'admin.report_management') ? 'active' : '' }}">
                <a href="{{ route('admin.report_management') }}">
                    <i class="fa fa-building-o"></i> <span>Report Management</span>
                </a>
            </li>
                        
            <li class="treeview {{ (\Request::route()->getName() == 'admin.listingCategories' || \Request::route()->getName() == 'admin.show_blog_category_form' || \Request::route()->getName() == 'admin.edit_blog_category_form' || \Request::route()->getName() == 'admin.show_blog_category' || \Request::route()->getName() == 'blog.array_search' || \Request::route()->getName() == 'admin.listingBlogs' || \Request::route()->getName() == 'blogMain.search' || \Request::route()->getName() == 'admin.show_blog' || \Request::route()->getName() == 'admin.show_blog_form' || \Request::route()->getName() == 'admin.edit_blog_form') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-rss"></i>
                    <span>Blog Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (\Request::route()->getName() == 'admin.listingCategories' || \Request::route()->getName() == 'admin.show_blog_category_form' || \Request::route()->getName() == 'admin.edit_blog_category_form' || \Request::route()->getName() == 'admin.show_blog_category' || \Request::route()->getName() == 'blog.search') ? 'active' : '' }}"><a href="{{ route('admin.listingCategories') }}"><i class="fa fa-angle-double-right"></i> Blog Categories</a></li>
                    <li class="{{ (\Request::route()->getName() == 'admin.listingBlogs' || \Request::route()->getName() == 'blogMain.search' || \Request::route()->getName() == 'admin.show_blog' || \Request::route()->getName() == 'admin.show_blog_form' || \Request::route()->getName() == 'admin.edit_blog_form') ? 'active' : '' }}"><a href="{{ route('admin.listingBlogs') }}"><i class="fa fa-angle-double-right"></i> Blog Listing</a></li>
                </ul>
            </li>            

            <li class="treeview {{ (\Request::route()->getName() == 'admin.contactListing' || \Request::route()->getName() == 'contact.search') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-envelope"></i>
                    <span>Contact Us</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (\Request::route()->getName() == 'admin.contactListing' || \Request::route()->getName() == 'contact.search') ? 'active' : '' }}"><a href="{{ route('admin.contactListing') }}"><i class="fa fa-angle-double-right"></i> Contact Listing</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>