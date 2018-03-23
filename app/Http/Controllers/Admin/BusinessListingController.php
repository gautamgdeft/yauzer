<?php

namespace App\Http\Controllers\Admin; 

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\BusinessCategory;
use App\BusinessListing;
use App\BusinessHour;
use App\Country;
use App\BusinessPicture;
use App\CreditCard;
use App\Discount;
use App\Yauzer;
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

    #Business-Search-Function
    public function search(Request $request)
    {
           $search_parameter = $request->search_parameter;
           if($search_parameter != "")
           {

            $filterBusiness = BusinessListing::where ( 'name', 'LIKE', '%' . $search_parameter . '%' )->paginate (10)->setPath ( '' );
            $pagination = $filterBusiness->appends ( array (
                  'search_parameter' => $request->search_parameter 
              ) );
              
            if (count ( $filterBusiness ) > 0)
            return view ( 'admin.business_listing.listing' )->withDetails ( $filterBusiness )->withQuery ( $search_parameter );
           }

            return view ( 'admin.business_listing.listing' )->withMessage ( 'No Details found. Try to search again !' );
    }      

    #Business-Listing-Function
    public function business_listing()
    {
    	$business_listing = BusinessListing::orderBy('id', 'desc')->paginate(10);
      return view('admin.business_listing.listing', ['business_listing' => $business_listing]);
    }

    #Business-Status-Upgrdation-Function
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

    #Destroy-Single-Business
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

    #Show-Single-Business-Function
    public function show_business($slug)
    {
       $businessListing = BusinessListing::findBySlugOrFail($slug);
       return view('admin.business_listing.show_business', ['businessListing' => $businessListing]);
    }

    #Show-Edit-Business-Form-Function
    public function edit_business($slug)
    {
       $country = Country::selectCountries();
       $businessListing = BusinessListing::findBySlugOrFail($slug);
       $businessHours = BusinessHour::where('business_id', $businessListing->id)->first();
       $businessPictures = BusinessPicture::where('business_id', $businessListing->id)->get();
       $businessPaymentInfo = CreditCard::where('business_id', $businessListing->id)->first();
       $businessDiscountInfo = Discount::where('business_id', $businessListing->id)->first();
       $businessYauzersInfo = Yauzer::where('business_id', $businessListing->id)->get();
       
       return view('admin.business_listing.edit_business', ['businessListing' => $businessListing, 'country' => $country, 'businessHours' => $businessHours, 'businessPictures' => $businessPictures, 'businessPaymentInfo' => $businessPaymentInfo, 'businessDiscountInfo' => $businessDiscountInfo, 'businessYauzersInfo' => $businessYauzersInfo]);
    }

    #Updating-Business-Function
    public function update_business(Request $request, $slug)
    {  
       $business = BusinessListing::findBySlugOrFail($slug);
        
       #Validating-Fields
       $validatedData = $request->validate([
            'name'              => 'required|string|max:255',
            #'business_category' => 'required|string',
            'address'           => 'required|string',
            'city'              => 'required|string',
            'state'             => 'required|string',
            'zipcode'           => 'required|numeric',
            'country'           => 'required|string',
            'phone_number'      => 'required',
            'avatar'            => 'image:jpg,png,jpeg,gif|unique:business_listings'
        ]);

        $business->update($request->all());

        #Updating Avatar If Present
        if($request->hasFile('avatar'))
        {   
          $avatar = $request->file('avatar');
           //Using Helper/helpers.php
           uploadBusinessMainAvatar($avatar, $business);
        } 

        return redirect()->route('admin.business_listing')->with("success","Business has been updated");       
    }


}
