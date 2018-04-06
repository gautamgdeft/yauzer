<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\BusinessListing;
use App\BusinessHour;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class BusinessHourController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
        $business = $user->business;   
    	$businessHours = BusinessHour::where('business_id', $business->id)->first();
        
        return view('owner.biz_hours.index', compact('business','businessHours'));
    }

    public function update_business_hours(Request $request, $slug)
    {   
    	   $business = BusinessListing::findBySlugOrFail($slug);
           $businessHours =  BusinessHour::updateOrCreate(['business_id' => $business->id], $request->all());
           
           return Redirect::back()->with('success', 'Business Hours has been updated successfully');
    }     
}
