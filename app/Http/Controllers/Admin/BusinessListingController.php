<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\BusinessCategory;
use App\BusinessListing;
use Image;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class BusinessListingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function business_listing()
    {
    	$business_listing = BusinessListing::all();
    	return view('admin.business_listing.listing', ['business_listing' => $business_listing]);
    }

    public function update_business_status(Request $request)
    {
    	 if ( $request->input('id') ) 
    	 {
              $businessListing = BusinessListing::find($request->input('id'));

              if($businessListing->status == false)
              {
              	$businessListing->status  = true;
              	$businessListing->save();
              	return response(['msg' => 'Business status has been approved successfully', 'status' => 'success']); 
              	
              }else{
              	$businessListing->status  = false;
              	$businessListing->save();
              	return response(['msg' => 'Business status has been rejected successfully', 'status' => 'declined']); 
              }	
    	 }

    	 return response(['msg' => 'Failed changing the status of business', 'status' => 'failed']);    	
    }


    public function destroy_business(Request $request)
    {
    	if ( $request->input('id') ) 
    	{
            $businessListing = BusinessListing::find($request->input('id'));
           
            if($businessListing->avatar != 'default.png')
            {
              $path = '/uploads/businessAvatars/' . $category->avatar;
              unlink(public_path() . $path);
            }
            $businessListing->delete();
            return response(['msg' => 'Business has been deleted successfully', 'status' => 'success']);
        }

            return response(['msg' => 'Failed deleting the business', 'status' => 'failed']);    	
    }


    public function show_business($slug)
    {
       $businessListing = BusinessListing::findBySlugOrFail($slug);
       return view('admin.business_listing.show_business', ['businessListing' => $businessListing]);
    } 
}
