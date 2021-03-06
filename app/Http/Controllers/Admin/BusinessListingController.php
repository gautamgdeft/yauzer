<?php

namespace App\Http\Controllers\Admin; 

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\BusinessCategory;
use App\BusinessSubcategory;
use App\BusinessListing;
use App\BusinessHour;
use App\Country;
use App\BusinessPicture;
use App\CreditCard;
use App\Discount;
use App\Yauzer;
use App\Speciality;
use App\InterestedBusiness;
use App\BusinessInfo;
use App\BusinessMoreInfo;
use App\Pricing;
use Image;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Mail\BusinessStatusMail;
use App\Mail\PremiumBusinessOwnerEmail;
use File;

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

            $filterBusiness = BusinessListing::select('business_listings.*','business_listings.name as businessname')->where ( 'business_listings.name', 'LIKE', '%' . $search_parameter . '%' )->withCount('yauzers')->sortable()->paginate (50)->setPath ( '' );
            $pagination = $filterBusiness->appends ( array (
                  'search_parameter' => $request->search_parameter 
              ) );
              
            if (count ( $filterBusiness ) > 0)
            return view ( 'admin.business_listing.listing' )->withDetails ( $filterBusiness )->withQuery ( $search_parameter );
           }

            return view ( 'admin.business_listing.listing' )->withMessage ( 'No Details found. Try to search again !' );
    }   

    #Business-Search-Between-Dates
    public function search_by_date_business(Request $request)
    {
        $filterBusiness = BusinessListing::select('business_listings.*','business_listings.name as businessname')->whereBetween('business_listings.created_at', [$request->start, $request->end])->withCount('yauzers')->sortable()->paginate (50)->setPath ( '' );
        $pagination = $filterBusiness->appends ( array (
              'start' => $request->start,
              'end'   => $request->end
          ) );
        if (count ( $filterBusiness ) > 0) {
         return view ( 'admin.business_listing.listing' )->withFilter ( $filterBusiness )->withStart ( $request->start )->withEnd( $request->end );
        }else{
         return view ( 'admin.business_listing.listing' )->withError ( 'No Details found. Try to search again !' );
        }      
    }   

    #Business-Listing-Function
    public function business_listing()
    {
    	$business_listing = BusinessListing::withCount('yauzers')->sortable()->orderBy('id', 'desc')->where('premium_status', false)->paginate(50);
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

                #Business-Approval-Email
                \Mail::to($businessListing->business_added_by->email)->send(new BusinessStatusMail($businessListing));
              	return response(['msg' => 'Business status has been approved successfully', 'status' => 'success']); 
              	
              }else{
              	$businessListing->status  = false;
              	$businessListing->save();
                #Business-Rejected-Email
                \Mail::to($businessListing->business_added_by->email)->send(new BusinessStatusMail($businessListing));
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
              $path = '/uploads/businessAvatars/' . $businessListing->avatar;
              unlink(public_path() . $path);
            }
            BusinessListing::delete_business($businessListing);
            return response(['msg' => 'Business has been deleted successfully', 'status' => 'success']);
        }

            return response(['msg' => 'Failed deleting the business', 'status' => 'failed']);    	
    }

    #Show-Single-Business-Function
    public function show_business($slug)
    {
       $businessListing = BusinessListing::findBySlugOrFail($slug);
        if(@sizeof($businessListing->business_subcategory)){
         $businessListing['business_subcategory'] = explode(',', $businessListing->business_subcategory);
         $business_subcategories = BusinessSubcategory::whereIn('id', $businessListing->business_subcategory)->pluck('name'); 
        }else{
          $business_subcategories = NULL;
        }       
       
       return view('admin.business_listing.show_business', ['businessListing' => $businessListing, 'business_subcategories' => $business_subcategories]);
    }

    #Show-Premiun-Business-Form
    public function show_premium_business($slug)
    {
       $businessListing = BusinessListing::findBySlugOrFail($slug);
        if(@sizeof($businessListing->business_subcategory)){
         $businessListing['business_subcategory'] = explode(',', $businessListing->business_subcategory);
         $business_subcategories = BusinessSubcategory::whereIn('id', $businessListing->business_subcategory)->pluck('name'); 
        }else{
          $business_subcategories = NULL;
        }       
       
       return view('admin.business_listing_premium.show_business', ['businessListing' => $businessListing, 'business_subcategories' => $business_subcategories]);      
    }

    #Show-Edit-Business-Form-Function
    public function edit_premium_business($slug)
    {
       $country = Country::selectCountries();
       $allBusinesses = BusinessListing::all();
       $businessListing = BusinessListing::findBySlugOrFail($slug);
       $businessHours = BusinessHour::where('business_id', $businessListing->id)->first();
       $businessPictures = BusinessPicture::where('business_id', $businessListing->id)->get();
       $businessPaymentInfo = CreditCard::where('business_id', $businessListing->id)->first();
       $businessDiscountInfo = Discount::where('business_id', $businessListing->id)->first();
       $businessYauzersInfo = Yauzer::orderBy('id', 'desc')->where('business_id', $businessListing->id)->get();
       $businessSpecialitiesInfo = Speciality::orderBy('id', 'desc')->where('business_id', $businessListing->id)->get();


       $intersetedBusinesses = InterestedBusiness::orderBy('id', 'desc')->where('business_id', $businessListing->id)->first();
        if(@sizeof($intersetedBusinesses->interested_businesses)){
         $intersetedBusinesses['interested_businesses'] = explode(',', $intersetedBusinesses->interested_businesses);
        }
       
       //Pedefined Business-Info-Admin
       $businessInfo = BusinessInfo::where('status', true)->where('user_id', 0)->orWhere('user_id', $businessListing->user_id)->get();
       $existing_db_business_info = BusinessMoreInfo::where('business_id', $businessListing->id)->pluck('business_info_id')->toArray();
       

       return view('admin.business_listing_premium.edit_business', ['businessListing' => $businessListing, 'country' => $country, 'businessHours' => $businessHours, 'businessPictures' => $businessPictures, 'businessPaymentInfo' => $businessPaymentInfo, 'businessDiscountInfo' => $businessDiscountInfo, 'businessYauzersInfo' => $businessYauzersInfo, 'businessSpecialitiesInfo' => $businessSpecialitiesInfo, 'allBusinesses' => $allBusinesses, 'intersetedBusinesses' => $intersetedBusinesses, 'businessInfo' => $businessInfo, 'existing_db_business_info' => $existing_db_business_info]);
    }

    public function edit_business($slug)
    {
      $business_categories = BusinessCategory::orderBy('id', 'desc')->where('status', 1)->get();
      $country = Country::selectCountries(); 
      $business = BusinessListing::findBySlugOrFail($slug);
      if(@sizeof($business->business_subcategory)){
        $subcategoryArray = explode(',', $business->business_subcategory);
      }else{
        $subcategoryArray = NULL;
      }      
      return view('admin.business_listing.edit_business', compact('business', 'country', 'business_categories', 'subcategoryArray'));
    }

    public function update_biz_basic_info(Request $request, $slug)
    {
      $business = BusinessListing::findBySlugOrFail($slug);
      $previousImage = $business->avatar;

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
        }else{
         $request['business_subcategory'] = NULL; 
        }
        
        $business->update($request->all());

        #Updating Avatar If Present
        if($request->hasFile('avatar'))
        {   

          $businessImage = public_path("uploads/businessAvatars/{$previousImage}"); // get previous image from folder
          if (File::exists($businessImage)) { // unlink or remove previous image from folder
              unlink($businessImage);
          }   

          $avatar = $request->file('avatar');
           //Using Helper/helpers.php
           uploadBusinessMainAvatar($avatar, $business);
        } 

       return redirect()->back()->withSuccess('You Business Basic Information has been updated successfully');      
    }

    public function change_biz_status($slug)
    {
      $business = BusinessListing::findBySlugOrFail($slug);
      $business->premium_status = true;
      $business->update();
      return redirect()->back()->withSuccess('Business status has been changed to Premium successfully.');      
    }    

    #Updating-Business-Function
    public function update_business(Request $request, $slug)
    {  
       $business = BusinessListing::findBySlugOrFail($slug);
       $previousImage = $business->avatar;

       #Validating-Fields
       $validatedData = $request->validate([
            'name'              => 'required|string|max:255',
            #'business_category' => 'required|string',
            'address'           => 'required|string',
            'city'              => 'required|string',
            'state'             => 'required|string',
            'zipcode'           => 'required',
            'country'           => 'required|string',
            'phone_number'      => 'required',
            'avatar'            => 'image:jpg,png,jpeg,gif|unique:business_listings'
        ]);

        $business->update($request->all());

        #Updating Avatar If Present
        if($request->hasFile('avatar'))
        {   
          $businessImage = public_path("uploads/businessAvatars/{$previousImage}"); // get previous image from folder
          if (File::exists($businessImage)) { // unlink or remove previous image from folder
              unlink($businessImage);
          }            
          $avatar = $request->file('avatar');
           //Using Helper/helpers.php
           uploadBusinessMainAvatar($avatar, $business);
        } 

        return redirect()->back()->withSuccess("Business has been updated");       
    }

    public function search_premium(Request $request)
    {
           $plans = Pricing::where('type', 'price')->pluck('yauzer');
           $search_parameter = $request->search_parameter;
           if($search_parameter != "")
           {

            $filterBusiness = BusinessListing::where ( 'business_listings.name', 'LIKE', '%' . $search_parameter . '%' )->has('yauzers', '>=' , $plans[0])->with('yauzers')->withCount('yauzers')->sortable()->paginate (50)->setPath ( '' );

            $pagination = $filterBusiness->appends ( array (
                  'search_parameter' => $request->search_parameter 
              ) );
              
            if (count ( $filterBusiness ) > 0)
            return view ( 'admin.business_listing_premium.listing' )->withDetails ( $filterBusiness )->withQuery ( $search_parameter );
           }
             
            $filterBusiness = NULL; 
            return view ( 'admin.business_listing_premium.listing' )->withDetails ( $filterBusiness )->withMessage ( 'No Details found. Try to search again !' );      
    }

    public function search_premium_by_date(Request $request)
    {
        $plans = Pricing::where('type', 'price')->pluck('yauzer');
        $filterBusiness = BusinessListing::select('business_listings.*','business_listings.name as businessname')->whereBetween('business_listings.created_at', [$request->start, $request->end])->has('yauzers', '>=' , $plans[0])->with('yauzers')->withCount('yauzers')->sortable()->paginate (50)->setPath ( '' );
        $pagination = $filterBusiness->appends ( array (
              'start' => $request->start,
              'end'   => $request->end
          ) );
        if (count ( $filterBusiness ) > 0) {
         return view ( 'admin.business_listing_premium.listing' )->withFilter ( $filterBusiness )->withStart ( $request->start )->withEnd( $request->end );
        }else{
         return view ( 'admin.business_listing_premium.listing' )->withError ( 'No Details found. Try to search again !' );
        }      
    }

    public function business_listing_premium()
    {
      $plans = Pricing::where('type', 'price')->pluck('yauzer');
      $business = BusinessListing::has('yauzers', '>=' , $plans[0])->withCount('yauzers')->with('yauzers')->sortable()->paginate(50);
      $details = NULL;
       return view('admin.business_listing_premium.listing', compact('business', 'details'));
    }

    public function business_premium_email_owner(Request $request)
    {
      if($request->ajax()){

        $business = BusinessListing::find($request->businessId);

         #Business-Qualifies-Premium-Listing-Email-to-Owner
          if(@sizeof($business->user)){
          \Mail::to($business->user->email)->send(new PremiumBusinessOwnerEmail($business));
          }

        return response(['msg' => 'Premium Business notification has been sent to the owner successfully', 'status' => 'success']);

        }else{
         return response(['msg' => 'Failed sending the email.Try again', 'status' => 'failed']);
        }  

    }

    public function get_subcategory(Request $request)
    {
       $businessSubcategories = BusinessSubcategory::where('business_category_id', $request->id)->where('status', 1)->get();
       if(@sizeof($businessSubcategories)){          
        return response()->json(['status' => 'success', 'businessSubcategories' => $businessSubcategories]);
       }else{
        return response(['msg' => 'Cannot find the business subcategories. Try again', 'status' => 'failed']);  
       }


    }    


}
