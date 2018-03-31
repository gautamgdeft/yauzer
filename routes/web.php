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

Auth::routes();


//Backend-Admin-Routes

Route::prefix('admin')->group(function()
{	
	Route::get('/login'     , 'Auth\AdminLoginController@showLoginform')->name('admin.login');
	Route::post('/login'    , 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/dashboard' , 'Admin\AdminController@index')->name('admin.dashboard');
	Route::get('/logout'    , 'Auth\AdminLoginController@logout')->name('admin.logout');
	Route::get('/profile'   , 'Admin\AdminController@profile')->name('admin.profile');
	Route::post('/update-profile', 'Admin\AdminController@update')->name('admin.update_profile');
	Route::get('/changepassword','Admin\AdminController@showChangePasswordForm')->name('admin.showChangePasswordForm');
	Route::post('/changepassword','Admin\AdminController@changepassword')->name('admin.changepassword');	


	//Admin-Password-Forgot-Routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');	
	Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');	
	Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');	
	Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

	//Customer-Management-Routes
    Route::any( '/search-customer', 'Admin\CustomerController@search')->name('customer.search');
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
    Route::any( '/search-owner', 'Admin\OwnerController@search')->name('owner.search');
    Route::get('/owners', 'Admin\OwnerController@owners')->name('admin.owners');
	Route::get('/new-owner', 'Admin\OwnerController@new_owner')->name('admin.show_owner_form');		
    Route::post('/new-owner', 'Admin\OwnerController@store_owner')->name('admin.store_owner');
    Route::post('/delete-owner', 'Admin\OwnerController@destroy_owner')->name('admin.destoy_owner');
    Route::get('/edit-owner/{slug}', 'Admin\OwnerController@edit_owner')->name('admin.edit_owner_form');
	Route::post('/update-owner/{slug}', 'Admin\OwnerController@update_owner')->name('admin.update_owner');    
    Route::post('/update-owner-registeration-status', 'Admin\OwnerController@update_reg_status')->name('admin.update_owner_registeration_status');    
    Route::post('/update-owner-status', 'Admin\OwnerController@update_owner_status')->name('admin.update_owner_status');	
    Route::get('/view-owner/{slug}', 'Admin\OwnerController@show_owner')->name('admin.show_owner');
    Route::get('/change-password/{slug}', 'Admin\OwnerController@change_password')->name('admin.change_password');   

    Route::post('/store-password/{slug}', 'Admin\OwnerController@store_password')->name('admin.store_password');

    //Business-Category-Routes
    Route::any( '/search-category', 'Admin\BusinessCategoryController@search')->name('category.search');
    Route::get('/business-categories', 'Admin\BusinessCategoryController@business_category_listing')->name('admin.business_category_listing');
    Route::get('/new-category', 'Admin\BusinessCategoryController@new_category')->name('admin.show_category_form');
    Route::post('/new-category', 'Admin\BusinessCategoryController@store_category')->name('admin.store_category');
    Route::get('/edit-category/{slug}', 'Admin\BusinessCategoryController@edit_category')->name('admin.edit_category_form');
    Route::post('/update-category/{slug}', 'Admin\BusinessCategoryController@update_category')->name('admin.update_category');
    Route::post('/delete-category', 'Admin\BusinessCategoryController@destroy_category')->name('admin.destroy_category');
    Route::post('/update-category-status', 'Admin\BusinessCategoryController@update_category_status')->name('admin.update_category_status');
    Route::get('/view-category/{slug}', 'Admin\BusinessCategoryController@show_category')->name('admin.show_category');

    //Business-SubCategory-Routes
    Route::any( '/search-subcategory/{slug}', 'Admin\BusinessSubcategoryController@search')->name('subcategory.search');
    Route::get('/view-subcategory/{slug}', 'Admin\BusinessSubcategoryController@show_subcategory')->name('admin.show_subcategory');
    Route::get('/new-subcategory/{slug}', 'Admin\BusinessSubcategoryController@new_subcategory')->name('admin.show_subcategory_form');
    Route::post('/store-subcategory/{slug}', 'Admin\BusinessSubcategoryController@store_subcategory')->name('admin.store_subcategory');
    Route::post('/update-sub-category-status', 'Admin\BusinessSubcategoryController@update_subcategory_status')->name('admin.update_subcategory_status');
    Route::post('/delete-subcategory', 'Admin\BusinessSubcategoryController@destroy_subcategory')->name('admin.destroy_subcategory');
    Route::get('/edit-subcategory/{category}/{slug}', 'Admin\BusinessSubcategoryController@edit_subcategory')->name('admin.edit_subcategory_form');
    Route::post('/update-subcategory/{category}/{slug}', 'Admin\BusinessSubcategoryController@update_subcategory')->name('admin.update_subcategory');                    


    //Business-Listings-Routes
    Route::any( '/search-business', 'Admin\BusinessListingController@search')->name('business.search');
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

    //Business-Payment-Info
    Route::post('/update-business-payment-information/{slug}', 'Admin\BusinessPaymentController@update_business_payment')->name('admin.update_business_payment');

    //Business-Description
    Route::get('/edit-business-description/{slug}', 'Admin\BusinessDescriptionController@edit_description_form')->name('admin.show_business_description_form');
    Route::post('/update-business-description/{slug}', 'Admin\BusinessDescriptionController@update_business_description')->name('admin.update_business_description');

    //Business-Discounts-Routes
    Route::post('/update-business-discount-information/{slug}', 'Admin\BusinessDiscountController@update_business_discount')->name('admin.update_business_discount');

    //Business-Yauzers-Routes
    Route::get('/add-business-yauzer/{slug}', 'Admin\BusinessYauzerController@new_yauzer')->name('admin.new_yauzer_form');
    Route::post('/store-business-yauzer/{slug}', 'Admin\BusinessYauzerController@store_yauzer')->name('admin.store_yauzer');    
    Route::get('/edit-business-yauzer/{yauzer_id}/{slug}', 'Admin\BusinessYauzerController@edit_yauzer')->name('admin.edit_yauzer');     
    Route::post('/update-business-yauzer/{yauzer_id}/{slug}', 'Admin\BusinessYauzerController@update_yauzer')->name('admin.update_yauzer');    
    Route::post('/destroy-business-yauzer', 'Admin\BusinessYauzerController@destory_yauzer')->name('admin.destory_yauzer');

    //Business-Speciality-Routes
   Route::get('/add-business-speciality/{slug}', 'Admin\BusinessSpecialityController@new_speciality')->name('admin.new_speciality_form');
   Route::post('/store-business-speciality/{slug}', 'Admin\BusinessSpecialityController@store_speciality')->name('admin.store_speciality');
   Route::get('/edit-business-speciality/{speciality_slug}/{slug}', 'Admin\BusinessSpecialityController@edit_speciality')->name('admin.edit_speciality'); 
   Route::post('/update-business-speciality/{speciality_slug}/{slug}', 'Admin\BusinessSpecialityController@update_speciality')->name('admin.update_speciality');   
   Route::post('/destroy-business-speciality', 'Admin\BusinessSpecialityController@destory_speciality')->name('admin.destory_speciality');

   //Business-Interested-Routes
    Route::post('/update-business-interested-information/{slug}', 'Admin\BusinessInterestedController@update_interested_business')->name('admin.update_interested_business');


 //Business-More-Info-Routes
    Route::get( '/more-info-listing', 'Admin\BusinessInfoController@show_listing')->name('business.more_info_listing');
    Route::get( '/add-more-info', 'Admin\BusinessInfoController@add_more_info')->name('business.add_more_info');   
    Route::post( '/add-more-info', 'Admin\BusinessInfoController@store_business_info')->name('business.store_business_info');
    Route::post('/update-info-status', 'Admin\BusinessInfoController@update_info_status')->name('admin.update_info_status');
    Route::post('/destroy-business-info', 'Admin\BusinessInfoController@destroy_business_info')->name('admin.destroy_business_info');

    Route::post('/search-business-info', 'Admin\BusinessInfoController@search')->name('businessinfo.search');
    Route::get('/edit-business-info/{slug}', 'Admin\BusinessInfoController@edit_business_info')->name('admin.edit_form');    
    Route::post('/update-business-info/{slug}', 'Admin\BusinessInfoController@update_business_info')->name('admin.update_business_info');

    //Seperate For Business-Listing-Edit-Info-Tab-Routes
    Route::post('/update-business-main-info/{slug}', 'Admin\BusinessInfoController@update_main_info')->name('admin.update_main_info');                   

 //Content-Management-Routes Starts

    //Manage-Pages-Routes
    Route::any( '/search-page', 'Admin\ContentManagementController@search')->name('page.search');       
	Route::get('/pages', 'Admin\ContentManagementController@pages')->name('admin.pages');
	Route::get('/new-page', 'Admin\ContentManagementController@show_page_form')->name('admin.show_page_form');
	Route::post('/new-page', 'Admin\ContentManagementController@store_page')->name('admin.store_page');
	Route::post('/update-page-status', 'Admin\ContentManagementController@update_page_status')->name('admin.update_page_status');
	Route::post('/delete-page', 'Admin\ContentManagementController@destroy_page')->name('admin.destroy_page');
    Route::get('/edit-page/{slug}', 'Admin\ContentManagementController@edit_page')->name('admin.edit_page_form');
    Route::post('/update-page/{slug}', 'Admin\ContentManagementController@update_page')->name('admin.update_page');    
    Route::get('/view-page/{slug}', 'Admin\ContentManagementController@view_page')->name('admin.view_page');

   //Manage-SliderImages-Routes
    Route::get('/sliderimages', 'Admin\ContentManagementController@sliderimages')->name('admin.sliderimages');
	Route::get('/new-slider-image', 'Admin\ContentManagementController@new_slider_image')->name('admin.new_slider_image');
    Route::post('/new-slider-image', 'Admin\ContentManagementController@store_slider_image')->name('admin.store_slider_image');
    Route::post('/delete-slider-image', 'Admin\ContentManagementController@destroy_slider_image')->name('admin.destroy_slider_image');
	Route::post('/update-slider-image-status', 'Admin\ContentManagementController@update_slider_image_status')->name('admin.update_slider_image_status');
    Route::get('/edit-slider-image/{slug}', 'Admin\ContentManagementController@edit_slider_image')->name('admin.edit_slider_image');
    Route::post('/update-slider-image/{slug}', 'Admin\ContentManagementController@update_slider_image')->name('admin.update_slider_image');     
    Route::get('/view-slider-image/{slug}', 'Admin\ContentManagementController@view_slider_image')->name('admin.view_slider_image');    	        		       			   	      

    //Manage-Header-Menu-Routes
    Route::any( '/search-header-menu', 'Admin\ContentManagementController@search_header_menu')->name('headermenu.search'); 
    Route::get('/header-menus', 'Admin\ContentManagementController@headermenus')->name('admin.headermenus');
    Route::get('/new-header-menu', 'Admin\ContentManagementController@show_header_menu_form')->name('admin.show_header_menu_form');
    Route::post('/new-header-menu', 'Admin\ContentManagementController@store_header_menu')->name('admin.store_header_menu');
    Route::post('/update-header-menu-status', 'Admin\ContentManagementController@update_header_menu_status')->name('admin.update_header_menu_status');     
    Route::post('/delete-header-menu', 'Admin\ContentManagementController@destroy_header_menu')->name('admin.destroy_header_menu');
    Route::get('/edit-header-menu/{slug}', 'Admin\ContentManagementController@edit_header_menu')->name('admin.edit_header_menu');
    Route::post('update-header-menu/{slug}', 'Admin\ContentManagementController@update_header_menu')->name('admin.update_header_menu');     
    Route::get('view-header-menu/{slug}', 'Admin\ContentManagementController@view_header_menu')->name('admin.view_header_menu'); 
    
    //Manage-Footer-Menu-Routes
    Route::any( '/search-footer-menu', 'Admin\ContentManagementController@search_footer_menu')->name('footermenu.search');     
    Route::get('/footer-menus', 'Admin\ContentManagementController@footermenus')->name('admin.footermenus');
    Route::get('/new-footer-menu', 'Admin\ContentManagementController@show_footer_menu_form')->name('admin.show_footer_menu_form');
    Route::post('/new-footer-menu', 'Admin\ContentManagementController@store_footer_menu')->name('admin.store_footer_menu');
    Route::post('/update-footer-menu-status', 'Admin\ContentManagementController@update_footer_menu_status')->name('admin.update_footer_menu_status');     
    Route::post('/delete-footer-menu', 'Admin\ContentManagementController@destroy_footer_menu')->name('admin.destroy_footer_menu');
    Route::get('/edit-footer-menu/{slug}', 'Admin\ContentManagementController@edit_footer_menu')->name('admin.edit_footer_menu');
    Route::post('update-footer-menu/{slug}', 'Admin\ContentManagementController@update_footer_menu')->name('admin.update_footer_menu');
    Route::get('view-footer-menu/{slug}', 'Admin\ContentManagementController@view_footer_menu')->name('admin.view_footer_menu'); 

    //Manage FAQ Routes
    Route::get('/faqs', 'Admin\ContentManagementController@faqs')->name('admin.faqs');
    Route::get('/new-faq', 'Admin\ContentManagementController@show_faq_form')->name('admin.show_faq_form');
    Route::post('/new-faq', 'Admin\ContentManagementController@store_faq')->name('admin.store_faq');
    Route::post('/update-faq-status', 'Admin\ContentManagementController@update_faq_status')->name('admin.update_faq_status');    
    Route::post('/destroy-faq', 'Admin\ContentManagementController@destroy_faq')->name('admin.destroy_faq');
    Route::get('/edit-faq/{slug}', 'Admin\ContentManagementController@edit_faq')->name('admin.edit_faq_form');
    Route::post('/update-faq/{slug}', 'Admin\ContentManagementController@update_faq')->name('admin.update_faq');
    Route::get('/view-faq/{slug}', 'Admin\ContentManagementController@view_faq')->name('admin.view_faq');       

    //Manage-Contact-US-Routes
    Route::any( '/search-contact', 'Admin\ContactusController@search')->name('contact.search');
    Route::get('/listing-contacts', 'Admin\ContactusController@listing')->name('admin.contactListing');
    Route::post('/delete-contact', 'Admin\ContactusController@destroy_contact')->name('admin.destroy_contact');   
    Route::get('/view-contact-detail/{id}', 'Admin\ContactusController@contact_details')->name('admin.contactdetail');

    //Report-Management-Routes                   
    Route::get('/report-management', 'Admin\ReportManagementController@show_reports')->name('admin.report_management');
    Route::get('/customer-export', 'Admin\ReportManagementController@customer_export')->name('admin.customer_export');
    Route::get('/owner-export', 'Admin\ReportManagementController@owner_export')->name('admin.owner_export');
    Route::get('/business-listing-export', 'Admin\ReportManagementController@business_export')->name('admin.business_export');
    Route::get('/yauzer-export', 'Admin\ReportManagementController@yauzer_export')->name('admin.yauzer_export');
});



//Frontend-User-Routes
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
Route::get('/', 'User\WelcomeController@index')->name('home.welcome');

//Only-Auth-With-All-Role-Routes
Route::group(['middleware' => ['auth']], function () {
 
Route::get('/home', 'User\WelcomeController@checkuser')->name('user.home');


});

//Only-Auth-With-User-Role-Routes
Route::group(['middleware' => ['auth', 'user']], function () {

 Route::get('/yauzer-a-business', 'User\BusinessController@yauzer_business')->name('user.yauzer_business');
 Route::post('/yauzer-a-business', 'User\BusinessController@save_yauzer')->name('user.save_yauzer');
 Route::post('/check-business', 'User\BusinessController@check_business')->name('user.check_business');
 Route::post('/get-business-subcategory', 'User\BusinessController@get_subcategory')->name('user.get_subcategory'); 
 Route::post('/checkemail', 'User\BusinessController@check_email')->name('user.checkEmail');

 Route::get('/user-dashboard', 'User\UserController@dashboard')->name('user.dashboard');
 Route::post('/update-profile', 'User\UserController@update_profile')->name('user.update_profile');

}); 

//Only-Auth-With-Owner-Role-Routes
Route::group(['middleware' => ['auth', 'owner']], function () {


});    

