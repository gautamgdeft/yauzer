<?php

namespace App\Http\Controllers\Admin;

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
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    

    public function update_business_hours(Request $request, $slug)
    {   
    	   $business = BusinessListing::findBySlugOrFail($slug);
           $businessHours =  BusinessHour::updateOrCreate(['business_id' => $business->id], $request->all());
           $route = 'admin/edit-business/'.$slug.'/#parentHorizontalTab2';
           return redirect($route)->with("success","Business Hours updated successfully");
           //return Redirect::back()->with('success', 'Business Hours updated successfully');
    } 
}
