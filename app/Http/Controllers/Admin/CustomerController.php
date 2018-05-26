<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Country;
use Image;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Mail;
use App\Mail\WelcomeMail;
use File;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function search(Request $request)
    {
           $search_parameter = $request->search_parameter;
           if($search_parameter != "")
           {

            $allusers = User::whereHas( 'roles', function($q){ $q->where('name', 'user'); } )->whereHas( 'roles', function($q){ $q->where('name', 'user'); } )->where ( 'name', 'LIKE', '%' . $search_parameter . '%' )->orWhere ( 'email', 'LIKE', '%' . $search_parameter . '%' )->whereHas( 'roles', function($q){ $q->where('name', 'user'); } )->withCount('yauzers')->sortable()->paginate (50)->setPath ( '' );
            $pagination = $allusers->appends ( array (
                  'search_parameter' => $request->search_parameter 
              ) );
              
            if (count ( $allusers ) > 0)
            return view ( 'admin.customer.user' )->withDetails ( $allusers )->withQuery ( $search_parameter );
           }

            return view ( 'admin.customer.user' )->withMessage ( 'No Details found. Try to search again !' );
    }

    public function search_by_date_customer(Request $request)
    {
        $allusers = User::whereBetween('users.created_at', [$request->start, $request->end])->whereHas( 'roles', function($q){ $q->where('name', 'user'); } )->withCount('yauzers')->sortable()->paginate (50)->setPath ( '' );
        $pagination = $allusers->appends ( array (
              'start' => $request->start,
              'end'   => $request->end
          ) );
        if (count ( $allusers ) > 0) {
         return view ( 'admin.customer.user' )->withFilter ( $allusers )->withStart ( $request->start )->withEnd( $request->end );
        }else{
         return view ( 'admin.customer.user' )->withError ( 'No Details found. Try to search again !' );
        }


    }       

    public function users()
    {
    	$users = User::whereHas( 'roles', function($q){ $q->where('name', 'user'); } )->withCount('yauzers')->sortable()->orderBy('id', 'desc')->paginate(50);

    	return view('admin.customer.user', ['allusers' => $users]);
    }

    public function new_user()
    {
      $country = Country::selectCountries();
      return view('admin.customer.new_user', compact('country'));
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
                        ->with("success","User has been added successfully");
         
    }


    public function edit_customer(Request $request, $slug)
    {
      $country = Country::selectCountries();
    	$user = User::findBySlugOrFail($slug);
    	return view('admin.customer.edit_customer_form', ['user' => $user, 'country' => $country]);    	
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
              $usersImage = public_path("uploads/avatars/{$user->avatar}"); // get previous image from folder
              if (File::exists($usersImage)) { // unlink or remove previous image from folder
                  unlink($usersImage);
              }              
               $avatar = $request->file('avatar');
           
               //Using Helper/helpers.php
               uploadAvatar($avatar, $user);
            } 

            $user->update($request->all());

			      Session::flash('success', 'User has been updated.');
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
              	return response(['msg' => 'User has been activated successfully', 'status' => 'success']); 
              	
              }else{
              	$user->login_status  = false;
              	$user->save();
              	return response(['msg' => 'User has been deactivated successfully', 'status' => 'declined']); 
              }	
    	 }    	
    }


    public function show_customer($slug)
    {
       $user = User::findBySlugOrFail($slug);
       return view('admin.customer.show_customer', ['user' => $user]);
    }


    
}
