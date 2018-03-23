<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\BusinessListing;
use App\CreditCard;
use App\Discount;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class BusinessDiscountController extends Controller
{
   public function __construct()
   {
	 $this->middleware('auth:admin');
   } 

   public function update_business_discount(Request $request, $slug)
   {
        //Validation-Working
        $validatedData = $request->validate([
        	'discount_title'  => 'required|string',
            'description'     => 'required|string',
            'valid_thru'      => 'required|date',
        ]);

       //Processing the Code
       $formatdate = Carbon::parse($request->valid_thru)->format('Y-m-d');
       $request['valid_thru'] = $formatdate;
   	   $business = BusinessListing::findBySlugOrFail($slug);
	   $businessDiscountInfo =  Discount::updateOrCreate(['business_id' => $business->id], $request->all());
       return Redirect::back()->with('success', 'Business update_business_discount has been updated successfully');
   }
}
