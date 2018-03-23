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

class BusinessDescriptionController extends Controller
{
   	public function __construct()
   	{
	 $this->middleware('auth:admin');
   	}     

    public function edit_description_form(Request $request, $slug)
    {
	  $businessListing = BusinessListing::findBySlugOrFail($slug);
 	  return view('admin.business_listing.partials.business_description.edit_description_form', ['businessListing' => $businessListing, 'slug' => $slug]);    	 
	}

    public function update_business_description(Request $request, $slug)
    {
      $businessListing = BusinessListing::findBySlugOrFail($slug);
      $businessListing->description = $request->description;
      $businessListing->update();
      
      return redirect()->route('admin.show_edit_business_form',['slug' => $slug])->with("success","Business Description has been updated successfully");
    }
}
