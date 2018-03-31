<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserController extends Controller
{
    public function dashboard()
    {    
    	 $countries = Country::selectCountries();
    	 return view('user.dashboard.dashboard', compact('countries'));														
    }

    public function update_profile(Request $request)
    {
        $user = Auth::user();

    		$validatedData = $request->validate([
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

            if(@sizeof($request->lastname))
            {
            	$request['name'] = $request->firstname.' '.$request->lastname;
            }else{
            	$request['name'] = $request->firstname;
            } 

            $user->update($request->all());
			return redirect()->back()->withSuccess('Your profile has been updated successfully');     	
    }
}
