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
});
