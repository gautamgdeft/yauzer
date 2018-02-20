<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use Image;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Mail;
use App\Mail\WelcomeMail;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function users()
    {
    	$users = User::whereHas( 'roles', function($q){ $q->where('name', 'user'); } )->get();
    	return view('admin.customer.user', ['allusers' => $users]);
    }

    public function new_user()
    {
    	return view('admin.customer.new_user');
    }

    public function store_user(Request $request)
    {

        $validatedData = $request->validate([
        	'name'         => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users',
            'password'     => 'required|string|min:6',
            'country'      => 'required|string',
            'address'      => 'required|string',
            'city'         => 'required|string',
            'state'        => 'required|string',
            'zipcode'      => 'required|numeric',
            'phone_number' => 'required',
            'avatar'       => 'unique:users'
        ]);


        //Storing User
    	   $user = User::create(
	              array(
	                   'name'          => $request->input('name'),
	                   'email'         => $request->input('email'),
	                   'password'      => bcrypt($request->input('password')),
	                   'country'       => $request->input('country'),
	                   'address'       => $request->input('address'),
	                   'city'          => $request->input('city'),
	                   'state'         => $request->input('state'),
	                   'zipcode'       => $request->input('zipcode'),
	                   'phone_number'  => $request->input('phone_number'),
	                   'login_status'  => true,
	                   'registeration_status' => true,
	                   

	             ));

         //Sending-User-Welcome-Email 
         \Mail::to($request->input('email'))->send(new WelcomeMail($user, $request->input('password')));

         //Assigning Role to User
         $user->assignRole('user');

         //Saving User Avatar
         if($request->hasFile('avatar'))
          {   
            $avatar = $request->file('avatar');

            //Using Helper/helpers.php
            uploadAvatar($avatar, $user);
            $user->save();
          }

         return redirect()->route('admin.users')
                        ->with("success","User has been added successfuly");
         
    }


    public function edit_customer(Request $request, $slug)
    {
    	$user = User::findBySlugOrFail($slug);
    	return view('admin.customer.edit_customer_form', ['user' => $user]);    	
    }


    public function update_customer(Request $request, $slug)
    {
        $user = User::findBySlugOrFail($slug);

    		$validatedData = $request->validate([
            	'name'         => 'required|string|max:255',
                'country'      => 'required|string',
                'address'      => 'required|string',
                'city'         => 'required|string',
                'state'        => 'required|string',
                'zipcode'      => 'required|numeric',
                'phone_number' => 'required',
                'avatar'       => 'unique:users'
            ]);


            if($request->hasFile('avatar'))
            {   
               $avatar = $request->file('avatar');
           
               //Using Helper/helpers.php
               uploadAvatar($avatar, $user);
            } 

            $user->update($request->all());
			      Session::flash('success', 'Customer was updated.');
            return redirect()->route('admin.users');                      

    }


    public function destroy_user(Request $request)
    {
    	 if ( $request->input('id') ) 
    	 {
            $user = User::find($request->input('id'));
           
            if($user->avatar != 'default.png'){
              $path = '/uploads/avatars/' . $user->avatar;
              unlink(public_path() . $path);
            }
            $user->delete();
            return response(['msg' => 'User has been deleted successfully', 'status' => 'success']);
         }

            return response(['msg' => 'Failed deleting the user', 'status' => 'failed']);
    }


    public function update_reg_status(Request $request)
    {
    	 if ( $request->input('id') ) 
    	 {
              $user = User::find($request->input('id'));

              if($user->registeration_status == false)
              {
              	$user->registeration_status  = true;
              	$user->save();
              	return response(['msg' => 'Registeration has been accepted successfully', 'status' => 'success']); 
              	
              }else{
              	$user->registeration_status  = false;
              	$user->save();
              	return response(['msg' => 'Registeration has been declined successfully', 'status' => 'declined']); 
              }	
    	 }
    }


    public function update_customer_status(Request $request)
    {
    	 if ( $request->input('id') ) 
    	 {
              $user = User::find($request->input('id'));

              if($user->login_status == false)
              {
              	$user->login_status  = true;
              	$user->save();
              	return response(['msg' => 'Customer has been activated successfully', 'status' => 'success']); 
              	
              }else{
              	$user->login_status  = false;
              	$user->save();
              	return response(['msg' => 'Customer has been deactivated successfully', 'status' => 'declined']); 
              }	
    	 }    	
    }


    public function show_customer($slug)
    {
       $user = User::findBySlugOrFail($slug);
       return view('admin.customer.show_customer', ['user' => $user]);
    }


    
}
