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


    //Business-Listings-Routes
	Route::get('/business-listings', 'Admin\BusinessListingController@business_listing')->name('admin.business_listing');
    Route::post('/delete-business', 'Admin\BusinessListingController@destroy_business')->name('admin.destroy_business');	
	Route::post('/update-business-status', 'Admin\BusinessListingController@update_business_status')->name('admin.update_business_status');
   Route::get('/view-business/{slug}', 'Admin\BusinessListingController@show_business')->name('admin.show_business');	      

});
