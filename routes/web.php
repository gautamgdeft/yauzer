<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function()
{	
	Route::get('/login'     , 'Auth\AdminLoginController@showLoginform')->name('admin.login');
	Route::post('/login'    , 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/dashboard' , 'AdminController@index')->name('admin.dashboard');
	Route::get('/logout'    , 'Auth\AdminLoginController@logout')->name('admin.logout');
	Route::get('/profile'   , 'AdminController@profile')->name('admin.profile');
	Route::post('/update-profile', 'AdminController@update')->name('admin.update_profile');
	Route::get('/changepassword','AdminController@showChangePasswordForm')->name('admin.showChangePasswordForm');
	Route::post('/changepassword','AdminController@changepassword')->name('admin.changepassword');	


	//Admin-Password-Forgot-Routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');	
	Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');	
	Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');	
	Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

	//Customer-Management-Routes
    Route::get('/customers', 'Admin\CustomerController@users')->name('admin.users');		
    Route::get('/new-customer', 'Admin\CustomerController@new_user')->name('admin.show_user_form');		
    Route::post('/new-customer', 'Admin\CustomerController@store_user')->name('admin.store_user');
    Route::post('/delete-customer', 'Admin\CustomerController@destroy_user')->name('admin.destoy_user');
    Route::get('/edit-customer/{slug}', 'Admin\CustomerController@edit_customer')->name('admin.show_edit_form');
    Route::post('/update-customer/{slug}', 'Admin\CustomerController@update_customer')->name('admin.update_customer');
    Route::post('/update-registeration-status', 'Admin\CustomerController@update_reg_status')->name('admin.update_registeration_status');    
    Route::post('/update-customer-status', 'Admin\CustomerController@update_customer_status')->name('admin.update_customer_status');
    Route::get('/view-customer/{slug}', 'Admin\CustomerController@show_customer')->name('admin.show_customer');

    //Owner-Management-Routes
    Route::get('/owners', 'Admin\OwnerController@owners')->name('admin.owners');
	Route::get('/new-owner', 'Admin\OwnerController@new_owner')->name('admin.show_owner_form');		
    Route::post('/new-owner', 'Admin\OwnerController@store_owner')->name('admin.store_owner');
    Route::post('/delete-owner', 'Admin\OwnerController@destroy_owner')->name('admin.destoy_owner');
    Route::get('/edit-owner/{slug}', 'Admin\OwnerController@edit_owner')->name('admin.edit_owner_form');
	Route::post('/update-owner/{slug}', 'Admin\OwnerController@update_owner')->name('admin.update_owner');    
    Route::post('/update-owner-registeration-status', 'Admin\OwnerController@update_reg_status')->name('admin.update_owner_registeration_status');    
    Route::post('/update-owner-status', 'Admin\OwnerController@update_owner_status')->name('admin.update_owner_status');	
    Route::get('/view-owner/{slug}', 'Admin\OwnerController@show_owner')->name('admin.show_owner');

    //Business-Category-Routes
    Route::get('/business-categories', 'Admin\BusinessCategoryController@business_category_listing')->name('admin.business_category_listing');
    Route::get('/new-category', 'Admin\BusinessCategoryController@new_category')->name('admin.show_category_form');
    Route::post('/new-category', 'Admin\BusinessCategoryController@store_category')->name('admin.store_category');
    Route::get('/edit-category/{slug}', 'Admin\BusinessCategoryController@edit_category')->name('admin.edit_category_form');
    Route::post('/update-category/{slug}', 'Admin\BusinessCategoryController@update_category')->name('admin.update_category');
    Route::post('/delete-category', 'Admin\BusinessCategoryController@destroy_category')->name('admin.destroy_category');
    Route::post('/update-category-status', 'Admin\BusinessCategoryController@update_category_status')->name('admin.update_category_status');
    Route::get('/view-category/{slug}', 'Admin\BusinessCategoryController@show_category')->name('admin.show_category');

    //Business-SubCategory-Routes
    Route::get('/view-subcategory/{slug}', 'Admin\BusinessSubcategoryController@show_subcategory')->name('admin.show_subcategory');
    Route::get('/new-subcategory/{slug}', 'Admin\BusinessSubcategoryController@new_subcategory')->name('admin.show_subcategory_form');
    Route::post('/store-subcategory/{slug}', 'Admin\BusinessSubcategoryController@store_subcategory')->name('admin.store_subcategory');
    Route::post('/update-sub-category-status', 'Admin\BusinessSubcategoryController@update_subcategory_status')->name('admin.update_subcategory_status');
    Route::post('/delete-subcategory', 'Admin\BusinessSubcategoryController@destroy_subcategory')->name('admin.destroy_subcategory');
    Route::get('/edit-subcategory/{slug}', 'Admin\BusinessSubcategoryController@edit_subcategory')->name('admin.edit_subcategory_form');
    Route::post('/update-subcategory/{slug}', 'Admin\BusinessSubcategoryController@update_subcategory')->name('admin.update_subcategory');                    


    //Business-Listings-Routes
	Route::get('/business-listings', 'Admin\BusinessListingController@business_listing')->name('admin.business_listing');
    Route::post('/delete-business', 'Admin\BusinessListingController@destroy_business')->name('admin.destroy_business');	
	Route::post('/update-business-status', 'Admin\BusinessListingController@update_business_status')->name('admin.update_business_status');
    Route::get('/view-business/{slug}', 'Admin\BusinessListingController@show_business')->name('admin.show_business');
    Route::get('/edit-business/{slug}', 'Admin\BusinessListingController@edit_business')->name('admin.show_edit_business_form');    
    Route::post('/update-business/{slug}', 'Admin\BusinessListingController@update_business')->name('admin.update_business');


    //Business-Hours-Routes    
    Route::post('/update-hours/{slug}', 'Admin\BusinessHourController@update_business_hours')->name('admin.update_business_hours');

    //Business-Pictures-Routes
    Route::get('/new-picture/{slug}', 'Admin\BusinessPictureController@new_picture')->name('admin.new_picture_form');    
    Route::post('/store-picture/{slug}', 'Admin\BusinessPictureController@store_picture')->name('admin.store_picture');
    Route::post('/destroy-picture', 'Admin\BusinessPictureController@destroy_picture')->name('admin.destroy_business_picture');

 //Content-Management-Routes Starts

    //Manage-Pages-Routes   
	Route::get('/pages', 'Admin\ContentManagementController@pages')->name('admin.pages');
	Route::get('/new-page', 'Admin\ContentManagementController@show_page_form')->name('admin.show_page_form');
	Route::post('/new-page', 'Admin\ContentManagementController@store_page')->name('admin.store_page');
	Route::post('/update-page-status', 'Admin\ContentManagementController@update_page_status')->name('admin.update_page_status');
	Route::post('/delete-page', 'Admin\ContentManagementController@destroy_page')->name('admin.destroy_page');
    Route::get('/edit-page/{slug}', 'Admin\ContentManagementController@edit_page')->name('admin.edit_page_form');
    Route::post('/update-page/{slug}', 'Admin\ContentManagementController@update_page')->name('admin.update_page');

   //Manage-SliderImages-Routes
    Route::get('/sliderimages', 'Admin\ContentManagementController@sliderimages')->name('admin.sliderimages');
	Route::get('/new-slider-image', 'Admin\ContentManagementController@new_slider_image')->name('admin.new_slider_image');
    Route::post('/new-slider-image', 'Admin\ContentManagementController@store_slider_image')->name('admin.store_slider_image');
    Route::post('/delete-slider-image', 'Admin\ContentManagementController@destroy_slider_image')->name('admin.destroy_slider_image');
	Route::post('/update-slider-image-status', 'Admin\ContentManagementController@update_slider_image_status')->name('admin.update_slider_image_status');
    Route::get('/edit-slider-image/{slug}', 'Admin\ContentManagementController@edit_slider_image')->name('admin.edit_slider_image');
    Route::post('/update-slider-image/{slug}', 'Admin\ContentManagementController@update_slider_image')->name('admin.update_slider_image');    	        		       			   	      

    //Manage-Header-Menu-Routes
    Route::get('/header-menus', 'Admin\ContentManagementController@headermenus')->name('admin.headermenus');
    Route::get('/new-header-menu', 'Admin\ContentManagementController@show_header_menu_form')->name('admin.show_header_menu_form');
    Route::post('/new-header-menu', 'Admin\ContentManagementController@store_header_menu')->name('admin.store_header_menu');
    Route::post('/update-header-menu-status', 'Admin\ContentManagementController@update_header_menu_status')->name('admin.update_header_menu_status');     
    Route::post('/delete-header-menu', 'Admin\ContentManagementController@destroy_header_menu')->name('admin.destroy_header_menu');
    Route::get('/edit-header-menu/{slug}', 'Admin\ContentManagementController@edit_header_menu')->name('admin.edit_header_menu');
    Route::post('update-header-menu/{slug}', 'Admin\ContentManagementController@update_header_menu')->name('admin.update_header_menu'); 
    
    //Manage-Footer-Menu-Routes
    Route::get('/footer-menus', 'Admin\ContentManagementController@footermenus')->name('admin.footermenus');
    Route::get('/new-footer-menu', 'Admin\ContentManagementController@show_footer_menu_form')->name('admin.show_footer_menu_form');
    Route::post('/new-footer-menu', 'Admin\ContentManagementController@store_footer_menu')->name('admin.store_footer_menu');
    Route::post('/update-footer-menu-status', 'Admin\ContentManagementController@update_footer_menu_status')->name('admin.update_footer_menu_status');     
    Route::post('/delete-footer-menu', 'Admin\ContentManagementController@destroy_footer_menu')->name('admin.destroy_footer_menu');
    Route::get('/edit-footer-menu/{slug}', 'Admin\ContentManagementController@edit_footer_menu')->name('admin.edit_footer_menu');
    Route::post('update-footer-menu/{slug}', 'Admin\ContentManagementController@update_footer_menu')->name('admin.update_footer_menu');

    //Manage FAQ Routes
    Route::get('/faqs', 'Admin\ContentManagementController@faqs')->name('admin.faqs');
    Route::get('/new-faq', 'Admin\ContentManagementController@show_faq_form')->name('admin.show_faq_form');
    Route::post('/new-faq', 'Admin\ContentManagementController@store_faq')->name('admin.store_faq');
    Route::post('/update-faq-status', 'Admin\ContentManagementController@update_faq_status')->name('admin.update_faq_status');    
    Route::post('/destroy-faq', 'Admin\ContentManagementController@destroy_faq')->name('admin.destroy_faq');
    Route::get('/edit-faq/{slug}', 'Admin\ContentManagementController@edit_faq')->name('admin.edit_faq_form');
    Route::post('/update-faq/{slug}', 'Admin\ContentManagementController@update_faq')->name('admin.update_faq');       

    //Manage-Contact-US-Routes
    Route::get('/listing-contacts', 'Admin\ContactusController@listing')->name('admin.contactListing');
    Route::post('/delete-contact', 'Admin\ContactusController@destroy_contact')->name('admin.destroy_contact');   
    Route::get('/view-contact-detail/{id}', 'Admin\ContactusController@contact_details')->name('admin.contactdetail');

    //Report-Management-Routes                   
    Route::get('/report-management', 'Admin\ReportManagementController@show_reports')->name('admin.report_management');
    Route::get('/export', 'Admin\ReportManagementController@export')->name('admin.export');
});
