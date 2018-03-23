<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Country;
use App\CreditCard;
use Image;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Mail;
use App\Mail\WelcomeMail;

class OwnerController extends Controller
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
            $allusers = User::where ( 'name', 'LIKE', '%' . $search_parameter . '%' )->whereHas( 'roles', function($q){ $q->where('name', 'owner'); } )->orWhere ( 'email', 'LIKE', '%' . $search_parameter . '%' )->whereHas( 'roles', function($q){ $q->where('name', 'owner'); } )->paginate (10)->setPath ( '' );
            $pagination = $allusers->appends ( array (
                  'search_parameter' => $request->search_parameter 
              ) );
              
            if (count ( $allusers ) > 0)
            return view ( 'admin.owner.owner_listing' )->withDetails ( $allusers )->withQuery ( $search_parameter );
           }

            return view ( 'admin.owner.owner_listing' )->withMessage ( 'No Details found. Try to search again !' );
    }    

    public function owners()
    {
      $users = User::whereHas( 'roles', function($q){ $q->where('name', 'owner'); } )->orderBy('id', 'desc')->paginate(10);
      return view('admin.owner.owner_listing', ['allusers' => $users]);
    }

    public function new_owner()
    {
      $country = Country::selectCountries();
    	return view('admin.owner.new_owner', compact('country'));
    }

    public function store_owner(Request $request)
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
         $user->assignRole('owner');

         //Saving User Avatar
         if($request->hasFile('avatar'))
          {   
            $avatar = $request->file('avatar');

            //Using Helper/helpers.php
            uploadAvatar($avatar, $user);
            $user->save();
          }

          return redirect()->route('admin.owners')
                        ->with("success","Owner has been added successfuly");
         
    }

    public function edit_owner(Request $request, $slug)
    {
      $country = Country::selectCountries();
    	$user = User::findBySlugOrFail($slug);
    	return view('admin.owner.edit_owner_form', ['user' => $user, 'country' => $country]);    	
    }


    public function update_owner(Request $request, $slug)
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

			      Session::flash('success', 'Owner has been updated.');
            return redirect()->route('admin.owners');                      

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


    public function update_owner_status(Request $request)
    {
    	 if ( $request->input('id') ) 
    	 {
              $user = User::find($request->input('id'));

              if($user->login_status == false)
              {
              	$user->login_status  = true;
              	$user->save();
              	return response(['msg' => 'Owner has been activated successfully', 'status' => 'success']); 
              	
              }else{
              	$user->login_status  = false;
              	$user->save();
              	return response(['msg' => 'Owner has been deactivated successfully', 'status' => 'declined']); 
              }	
    	 }    	
    }                


    public function destroy_owner(Request $request)
    {
    	 if ( $request->input('id') ) 
    	 {
            $user = User::find($request->input('id'));
           
            if($user->avatar != 'default.png'){
              $path = '/uploads/avatars/' . $user->avatar;
              if(file_exists( '/uploads/avatars/' . $user->avatar)) { 
              unlink(public_path() . $path);
              }
            }

            User::delete_user($user);

            return response(['msg' => 'Owner has been deleted successfully', 'status' => 'success']);
         }

            return response(['msg' => 'Failed deleting the owner', 'status' => 'failed']);
    }


    public function show_owner($slug)
    {
       $user = User::findBySlugOrFail($slug);
       return view('admin.owner.show_owner', ['user' => $user]);
    }                
}
