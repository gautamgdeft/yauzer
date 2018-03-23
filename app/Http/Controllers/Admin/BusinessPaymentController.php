<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\BusinessListing;
use App\CreditCard;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class BusinessPaymentController extends Controller
{
   
   public function __construct()
   {
	 $this->middleware('auth:admin');
   } 

   public function update_business_payment(Request $request, $slug)
   {
	   $business = BusinessListing::findBySlugOrFail($slug);
	   $businessPaymentInfo =  CreditCard::updateOrCreate(['business_id' => $business->id], $request->all());
       return Redirect::back()->with('success', 'Business Payment Information has been updated successfully');
   }
}
