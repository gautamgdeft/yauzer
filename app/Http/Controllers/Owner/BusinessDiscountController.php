<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Discount;
use App\BusinessListing;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class BusinessDiscountController extends Controller
{
   public function index()
   {
   	    $business = Auth::user()->business;
    	$businessDiscountInfo = Discount::where('business_id', Auth::user()->business->id)->first();
    	return view('owner.business_discount.index', compact('businessDiscountInfo', 'business'));
   }

   public function update_business_discount(Request $request, $slug)
   {
        //Validation-Working-Starts
        $validatedData = $request->validate([
        	'discount_title'  => 'required|string',
            'description'     => 'required|string',
            'valid_thru'      => 'required',
        ]);

       //Processing the Code
       $formatdate = Carbon::parse($request->valid_thru)->format('Y-m-d');
       $request['valid_thru'] = $formatdate;
   	   $business = BusinessListing::findBySlugOrFail($slug);
	     $businessDiscountInfo =  Discount::updateOrCreate(['business_id' => $business->id], $request->all());
       
        return Redirect::back()->with('success', 'Business Discount has been updated successfully');
   }    
}
