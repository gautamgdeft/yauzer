<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BusinessListing;
use App\BusinessCategory;
use App\BusinessSubcategory;
use App\Yauzer;
use App\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Http\Requests;
use Carbon\Carbon;
use App\Mail\BusinessNotificationAdminMail;

class BusinessController extends Controller
{
    public function yauzer_business()
    {
    	$businesses = BusinessListing::orderBy('id', 'desc')->where('status', 1)->get();
      $business_categories = BusinessCategory::orderBy('id', 'desc')->where('status', 1)->get();
      return view('user.yauzer_business.index', compact('businesses','business_categories'));
    }

    public function check_business(Request $request)
    {
      $businesses = $this->get_business($request->id);
      if(sizeof($businesses)){
       return response()->json(['status' => 'success', 'business' => $businesses]);
      }
      return response(['msg' => 'Cannot find the business details. Try again', 'status' => 'failed']);
    }

    public function save_yauzer(Request $request)
    { 
      #Checking User yauzer Adding limitations

      #Per-Day-Limit-On-All-Business
      if($this->yauzer_adding_avaliablity($request->business_id) === 'total_yauzer_per_day_limit_exceeded') 
      {
		    return redirect()->back()->withSuccess('You can only yauzer 5 businesses per day'); 
      }
      elseif(($this->yauzer_adding_avaliablity($request->business_id) == 0))
      {
          #Working of saving yauzer if business exist
  	    	if(isset($request->business_id) && ($request->business_id != 'other')){
  	         #Runing validations
  	         $validatedData = $request->validate([
  	        	'yauzer'              => 'required|string',
  	         ]);

  	         $request['user_id'] = \Auth::user()->id; 
  	         $request['ip_address'] = request()->ip(); 
  	         $yauzer = new Yauzer($request->all()); 
  	         $yauzer->save();
  	         return redirect()->back()->withSuccess('Congratulations you have successfully yauzered a business');
  		
  		    }else{
            #If Business is not present in our db plus saving business and yauzer:-
            $request['added_by'] = \Auth::user()->id;
      		  
            #Imploding Business Subcategories
      		  if(@sizeof($request->business_subcategory)){
      		   $request['business_subcategory'] = implode(',', $request->business_subcategory);
      		  }

    	      $business = new BusinessListing($request->all());
    	      $business->save();
            
            #Business-Notification-Email-Admin
             \Mail::to('teamphp00@gmail.com')->send(new BusinessNotificationAdminMail($business));
    	      
    	      #After Saving Business now Saving Yauzer
    	        $request['business_id'] = $business->id;
    	        $request['user_id'] = \Auth::user()->id;
    	        $request['ip_address'] = request()->ip(); 
    			    
              $yauzer = new Yauzer($request->all()); 
    	         $yauzer->save();
    	         return redirect()->back()->withSuccess('Congratulations you have successfully added a business and yauzered it. It will be published once approved by Admin');
  		     }
  

      }else{
       #Per-Day-Limit-For-Giving-User 
 			 return redirect()->back()->withSuccess('You have already yauzered this business today, try with another business');     	
      }//Yauzer adding endif
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

    public function check_email(Request $request)
    {
       if($request->ajax()){
       $users = BusinessListing::where('email', $request->email)->get();
       if(@sizeof($users)){
         return "Business with this email already exists!";
       }else{
       	 return "true";
       }
       }
    }



    protected function get_business($business_id)
    {
    	return $businesses = BusinessListing::find($business_id);
    }

    protected function yauzer_adding_avaliablity($business_id)
    {
      $carbon_today = Carbon::today();
      $today_date = $carbon_today->toDateString();
      $user_ip = request()->ip();
      $user_id = \Auth::user()->id;
      
      $total_yauzer_per_day = Yauzer::where('user_id', $user_id)->whereDate('created_at', $today_date)->where('ip_address', $user_ip)->count();

      if($total_yauzer_per_day < 5){
      return $getting_Business = Yauzer::where('business_id', $business_id)->where('user_id', $user_id)->whereDate('created_at', $today_date)->where('ip_address', $user_ip)->count();
      }else{
      	return 'total_yauzer_per_day_limit_exceeded';
      }

    }
}
