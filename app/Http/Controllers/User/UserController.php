<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Country;
use App\Yauzer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserController extends Controller
{
    public function dashboard()
    {    
         $splitName = explode(' ', Auth::user()->name, 2);
         $countries = Country::selectCountries();
    	 return view('user.dashboard.dashboard', compact('countries','splitName'));														
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

    public function yauzers()
    {
        $yauzers = Yauzer::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->whereHas('business',function ($q) { $q->where('status', '1'); })->get(); 
        return view('user.dashboard.yauzers', compact('yauzers'));
    }

    public function update_yauzer(Request $request)
    {      
            if($request->rating == NULL){
             $request['rating'] = 0;}
           $business = Yauzer::find($request->id);
           if(@sizeof($business)){

            $business->update($request->all());
            return redirect()->back()->withSuccess('Yauzer has been updated successfully');
           }else{
            return redirect()->back()->withErrors(['Cannot find business. Try Again']);
           }
    }
}
