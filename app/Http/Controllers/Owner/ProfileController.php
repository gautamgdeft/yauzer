<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Country;
use Session;
use Hash;

class ProfileController extends Controller
{
    public function profile()
    {
    	$country = Country::selectCountries();
    	return view('owner.dashboard.profile', ['user' => Auth::user(), 'country' => $country]);
    }

    public function update_profile(Request $request)
    {
            $user = Auth::user();
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
            return redirect()->back()->withSuccess('You profile has been updated successfully');                  
    }

    public function logout()
    {
       Auth::logout();
       return redirect()->route('owner.login');
    }

    public function changepasswordform()
    {
         return view('auth.passwords.ownerchangepassword', ['user' => Auth::user()]);
    }

    public function changePassword(Request $request)
    {
          if (!(Hash::check($request->get('current-password'), Auth::user()->password))) 
          {
            // The passwords matches
               return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
          }
        
          if(strcmp($request->get('current-password'), $request->get('new-password')) == 0)
          {
            //Current password and new password are same
              return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
          }

            $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password'     => 'required|string|min:6|confirmed',
            ]);
            
            //Change Password
            $user = Auth::user();
            $user->password = bcrypt($request->get('new-password'));
            $user->save();
            return redirect()->back()->with("success","Your Password has been changed successfully !");
    }    
}
