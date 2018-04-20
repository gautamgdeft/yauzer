<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\InterestedBusiness;
use App\BusinessListing;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class BusinessInterestedController extends Controller
{
   public function __construct()
   {
	 $this->middleware('auth:admin');
   }

   public function update_interested_business(Request $request, $slug)
   {
   	 $request['interested_businesses'] = implode(',', $request->interested_businesses);
   	 $businessInterestedInfo =  InterestedBusiness::updateOrCreate(['business_id' => $request->business_id], $request->all());

     $route = 'admin/edit-premium-business/'.$slug.'/#parentHorizontalTab10';
     return redirect($route)->with("success","Interested Business has been added successfuly");      
     #return redirect()->route('admin.show_edit_business_form', ['slug' => $slug])->with("success","Interested Business has been added successfuly");
   }

}
