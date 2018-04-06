<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Http\Requests;
use App\BusinessListing;
use App\BusinessCategory;
use App\Country;
use App\Mail\BusinessNotificationAdminMail;

class BusinessController extends Controller
{
    public function yauzer_business()
    {
		$businesses = BusinessListing::orderBy('id', 'desc')->where('status', 1)->where('user_id', '')->orWhere('user_id', NULL)->get();
        $business_categories = BusinessCategory::orderBy('id', 'desc')->where('status', 1)->get();    	
    	return view('owner.yauzer_for_business.index', compact('businesses','business_categories'));
    }

    public function check_business(Request $request)
    {
      $businesses = BusinessListing::get_business($request->id);
      if(sizeof($businesses)){
       return response()->json(['status' => 'success', 'business' => $businesses]);
      }
      return response(['msg' => 'Cannot find the business details. Try again', 'status' => 'failed']);
    }

    public function claim_business(Request $request)
    {
       if(isset($request->clain_business)){
        #Claiming Business
       	$businesses = BusinessListing::get_business($request->business_id);
       	$businesses->user_id = \Auth::user()->id;
        $businesses->save();

       	return redirect()->route('owner.dashboard')->withSuccess('Congratulations you have successfully claimed your business.');

       }else{
       	#If business is not present in db saving it into db
        $request['added_by'] = \Auth::user()->id;
        $request['user_id']  = \Auth::user()->id;
  		  
        #Imploding Business Subcategories
  		  if(@sizeof($request->business_subcategory)){
  		   $request['business_subcategory'] = implode(',', $request->business_subcategory);
  		  }
        
        $request['status'] = true; //Approved-Business-Status
        $business = new BusinessListing($request->all());
	    $business->save();

	    #Business-Notification-Email-Admin
        \Mail::to('teamphp00@gmail.com')->send(new BusinessNotificationAdminMail($business));
    	return redirect()->route('owner.dashboard')->withSuccess('Congratulations you have successfully added business.');   

       }

    }

    public function edit_biz_basic_info()
    {
    	$user = Auth::user();
    	$business_categories = BusinessCategory::orderBy('id', 'desc')->where('status', 1)->get();
    	$country = Country::selectCountries(); 
    	$business = $user->business;
    	if(@sizeof($business->business_subcategory)){
    		$subcategoryArray = explode(',', $business->business_subcategory);
    	}else{
    		$subcategoryArray = NULL;
    	}
    	return view('owner.biz_basic_info.index', compact('business','country', 'business_categories','subcategoryArray'));
    }

    public function update_biz_basic_info(Request $request, $slug)
    {

    	$business = BusinessListing::findBySlugOrFail($slug);

       #Validating-Fields
       $validatedData = $request->validate([
            'name'              => 'required|string|max:255',
            'business_category' => 'required',
            'address'           => 'required|string',
            'city'              => 'required|string',
            'state'             => 'required|string',
            'zipcode'           => 'required',
            'country'           => 'required|string',
            'avatar'            => 'image:jpg,png,jpeg,gif|unique:business_listings'
        ]);

        #Imploding Business Subcategories
        if(@sizeof($request->business_subcategory)){
         $request['business_subcategory'] = implode(',', $request->business_subcategory);
        }

        $business->update($request->all());

        #Updating Avatar If Present
        if($request->hasFile('avatar'))
        {   
          $avatar = $request->file('avatar');
           //Using Helper/helpers.php
           uploadBusinessMainAvatar($avatar, $business);
        } 

       return redirect()->back()->withSuccess('You Business Basic Information has been updated successfully');     	
    }


    public function edit_biz_additional_info()
    {
      $user = Auth::user();
      $business = $user->business;
      return view('owner.additional_biz_info.index', compact('business')); 
    }

    public function update_biz_additional_info(Request $request, $slug)
    {
      $business = BusinessListing::findBySlugOrFail($slug);

       #Validating-Fields
       $validatedData = $request->validate([
                      
           'phone_number' => 'required',
           'fax_number'   => 'required',
        ]);

        $business->update($request->all());
        return redirect()->back()->withSuccess('Your Additional Biz Information has been updated successfully');
    }

    public function check_email(Request $request)
    {
       if($request->ajax()){
       $business = BusinessListing::where('email', $request->email)->first();
       
       if(@sizeof($business->user)){
         if(@sizeof($business) && ($business->user->id != Auth::user()->id)){
           return "Business with this email already exists!";
         }else{
           return "true";
         }
       }else{
         if(@sizeof($business)) {
           return "Business with this email already exists!";
         }else{
           return "true";
         }
     }
       
       }
    
    }    
}
