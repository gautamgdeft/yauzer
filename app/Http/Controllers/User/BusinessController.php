<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BusinessListing;
use App\BusinessCategory;
use App\BusinessSubcategory;
use App\Yauzer;
use App\User;
use App\BusinessInfo;
use App\SiteSeo;
use App\SiteCms;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Http\Requests;
use Carbon\Carbon;
use App\Mail\BusinessNotificationAdminMail;
use App\Mail\PremiumBusinessAdminEmail;
use App\Mail\BusinessDirectionsMail;
use Illuminate\Support\Facades\DB;
use GeoIP;
use Geocoder\Laravel\Facades\Geocoder;
use DateTime;
use Image;
use File;
use App\Pricing;

class BusinessController extends Controller
{
    public function yauzer_business()
    {
      #For Showing Selected Business
      $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
      $uri_segments = explode('/', $uri_path);
      if(@sizeof($uri_segments[2])){
        $choosedBusiness = BusinessListing::findBySlugOrFail($uri_segments[2]);
      }else{
        $uri_segments = NULL;
        $choosedBusiness = NULL;
      }

       if(@sizeof($choosedBusiness)){
        $businesses = BusinessListing::where('slug', $uri_segments[2])->get();
       }else{ 
       $location = GeoIP::getLocation();
       $circle_radius = 3959;
       $max_distance = 50;
       $lat = $location->lat;
       $lng = $location->lon;
       $status = 1;

      #Showing business default list according to user Geo-ip address
      $businesses = DB::select('SELECT * FROM (SELECT *, (' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' . $lng . ')) + sin(radians(' . $lat . ')) * sin(radians(latitude)))) AS distance FROM business_listings) AS distances WHERE distance < ' . $max_distance . ' AND status = '.$status.' ORDER BY name ASC');
       }
      
      $business_categories = BusinessCategory::orderBy('id', 'desc')->where('status', 1)->get();
      return view('user.yauzer_business.index', compact('businesses','business_categories', 'uri_segments', 'choosedBusiness'));
    }

    public function check_business(Request $request)
    {
      $businesses = BusinessListing::get_business($request->id);
      if(sizeof($businesses)){
       return response()->json(['status' => 'success', 'business' => $businesses]);
      }
      return response(['msg' => 'Cannot find the business details. Try again', 'status' => 'failed']);
    }

    public function save_yauzer(Request $request)
    { 
      $plans = Pricing::where('type', 'price')->pluck('yauzer');
      if($request->rating == NULL)
      {
        $request['rating'] = 0;
      }
      #Checking User yauzer Adding limitations

      #Per-Day-Limit-On-All-Business
      if($this->yauzer_adding_avaliablity($request->business_id) === 'total_yauzer_per_day_limit_exceeded') 
      {
		    return redirect()->back()->withSuccess('You can only add five business yauzers per day'); 
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

             if($yauzer->count() == $plans[0]){
              #Premium-Business-Notification-Email-Admin
              \Mail::to('teamphp00@gmail.com')->send(new PremiumBusinessAdminEmail($yauzer->business));
             }
             Session::flash('success_msz_business', 'Congratulations you have successfully yauzered a business.'); 
             return redirect()->back();
  		
  		    }else{
            #If Business is not present in our db plus saving business and yauzer:-
            $request['added_by'] = \Auth::user()->id;
      		  
            #Imploding Business Subcategories
      		  if(@sizeof($request->business_subcategory)){
      		   $request['business_subcategory'] = implode(',', $request->business_subcategory);
      		  }
            
            $request['status'] = true; //Approved-Business-Status
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

               if($yauzer->count() == $plans[0]){
                #Premium-Business-Notification-Email-Admin
                \Mail::to('teamphp00@gmail.com')->send(new PremiumBusinessAdminEmail($yauzer->business));
               }
             
             Session::flash('success_msz_business', 'Congratulations you have successfully added a business and yauzered it.'); 
             return redirect()->back();
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

    public function get_business(Request $request)
    {
       $circle_radius = 3959;
       $max_distance = 50;
       $lat = $request->lat;
       $lng = $request->long;
       $status = 1;

      #Showing business default list according to user Geo-ip address
      $businesses = DB::select('SELECT * FROM (SELECT *, (' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' . $lng . ')) + sin(radians(' . $lat . ')) * sin(radians(latitude)))) AS distance FROM business_listings) AS distances WHERE distance < ' . $max_distance . ' AND status = '.$status.' ORDER BY name ASC');

       if(@sizeof($businesses)){          
        return response()->json(['status' => 'success', 'businesses' => $businesses]);
       }else{
        return response(['msg' => 'Cannot find the business. Try again', 'status' => 'failed']);  
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

    public function business_detail($slug)
    {
        $businessDetail = BusinessListing::findBySlugOrFail($slug);
        $businessCMSdata = SiteCms::where('slug', 'business')->first();
        $socialShareCms = SiteCms::where('slug', 'social-share-messages')->first();

        //Interested-Business-Working
        if(@sizeof($businessDetail->interested_business->interested_businesses)){
          $explodedArray = explode(',', $businessDetail->interested_business->interested_businesses);
          $interestedBusiness = [];
          foreach ($explodedArray as $businessId) {
          $interestedBusiness[] = BusinessListing::find($businessId);
          }
        }else{
          $interestedBusiness = NULL;
        }  

        if($businessDetail->premium_status == false){
         
         return view('home.basic_business_detail', compact('businessDetail','interestedBusiness', 'businessCMSdata', 'socialShareCms'));
 
        }else{  
        //Hours-Section-Business-Hours
        $carbon=Carbon::now();
        $currentdayname = $carbon->format('l');
       
        $newbusinessHour = [];
        if(sizeof($businessDetail->business_hour)){
        $newbusinessHour['Sunday']        = $businessDetail->business_hour->sun_open .' - '. $businessDetail->business_hour->sun_close;
        $newbusinessHour['Sunday_open']   = $businessDetail->business_hour->sun_open;         
        $newbusinessHour['Sunday_close']  = $businessDetail->business_hour->sun_close;
        $newbusinessHour['Sunday_status'] = $businessDetail->business_hour->sun_status;

        $newbusinessHour['Monday']        = $businessDetail->business_hour->mon_open .' - '. $businessDetail->business_hour->mon_close;
        $newbusinessHour['Monday_open']   = $businessDetail->business_hour->mon_open;         
        $newbusinessHour['Monday_close']  = $businessDetail->business_hour->mon_close;        
        $newbusinessHour['Monday_status'] = $businessDetail->business_hour->mon_status;        

        $newbusinessHour['Tuesday']       = $businessDetail->business_hour->tue_open .' - '. $businessDetail->business_hour->tue_close;
        $newbusinessHour['Tuesday_open']  = $businessDetail->business_hour->tue_open;         
        $newbusinessHour['Tuesday_close'] = $businessDetail->business_hour->tue_close;
        $newbusinessHour['Tuesday_status'] = $businessDetail->business_hour->tue_status;

        $newbusinessHour['Wednesday']      = $businessDetail->business_hour->wed_open .' - '. $businessDetail->business_hour->wed_close;
        $newbusinessHour['Wednesday_open']  = $businessDetail->business_hour->wed_open;         
        $newbusinessHour['Wednesday_close'] = $businessDetail->business_hour->wed_close;
        $newbusinessHour['Wednesday_status'] = $businessDetail->business_hour->wed_status;

        $newbusinessHour['Thursday']  = $businessDetail->business_hour->thur_open .' - '. $businessDetail->business_hour->thur_close;
        $newbusinessHour['Thursday_open']  = $businessDetail->business_hour->thur_open;         
        $newbusinessHour['Thursday_close'] = $businessDetail->business_hour->thur_close;
        $newbusinessHour['Thursday_status'] = $businessDetail->business_hour->thur_status;

        $newbusinessHour['Friday']    = $businessDetail->business_hour->fri_open .' - '. $businessDetail->business_hour->fri_close;
        $newbusinessHour['Friday_open']  = $businessDetail->business_hour->fri_open;         
        $newbusinessHour['Friday_close'] = $businessDetail->business_hour->fri_close;        
        $newbusinessHour['Friday_status'] = $businessDetail->business_hour->fri_status;
        
        $newbusinessHour['Saturday']  = $businessDetail->business_hour->sat_open .' - '. $businessDetail->business_hour->sat_close;                        
        $newbusinessHour['Saturday_open']  = $businessDetail->business_hour->sat_open;         
        $newbusinessHour['Saturday_close'] = $businessDetail->business_hour->sat_close;        
        $newbusinessHour['Saturday_status'] = $businessDetail->business_hour->sat_status;
        }else{
          $newbusinessHour = NULL;
        }
         
        return view('home.business_detail', compact('businessDetail','interestedBusiness', 'currentdayname', 'newbusinessHour', 'businessCMSdata', 'socialShareCms'));
        }
    }

    public function search_by_category($slug)
    {
       $businessCMSdata = SiteCms::where('slug', 'business')->first();
       $resultcms = SiteCms::where('slug', 'result-page')->first();
       $businessCategory = BusinessCategory::findBySlugOrFail($slug);
       $location = GeoIP::getLocation();
       $circle_radius = 3959;
       $max_distance = 50;
       $lat = $location->lat;
       $lng = $location->lon;

       $businesses = DB::select('SELECT * FROM (SELECT *, (' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' . $lng . ')) + sin(radians(' . $lat . ')) * sin(radians(latitude)))) AS distance FROM business_listings) AS distances WHERE distance < ' . $max_distance . ' AND business_category = '.$businessCategory->id.' ORDER BY distance');

       return view('home.category_search', compact('businesses', 'businessCategory', 'location', 'resultcms', 'businessCMSdata'));     
                
    }


    public function search_business(Request $request)
    {
       $businessCMSdata = SiteCms::where('slug', 'business')->first();
       $resultcms = SiteCms::where('slug', 'result-page')->first();
       $data = Geocoder::geocode($request->geo_location_terms)->all();
       $simpleAddress = $request->geo_location_terms;
       $formattedAddress = explode(',', $request->geo_location_terms);
       $circle_radius = 3959;
       $max_distance = 50;
       $lat = $data[0]->getcoordinates()->getlatitude();
       $lng = $data[0]->getcoordinates()->getlongitude();
       $parameter = $request->search_terms;
       
       if(sizeof($parameter)){
       $businesses = DB::select('SELECT * FROM (SELECT *, (' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' . $lng . ')) + sin(radians(' . $lat . ')) * sin(radians(latitude)))) AS distance FROM business_listings) AS distances WHERE distance < ' . $max_distance . ' AND name LIKE "%'.$parameter.'%" ORDER BY distance');
       }else{
       $businesses = DB::select('SELECT * FROM (SELECT *, (' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' . $lng . ')) + sin(radians(' . $lat . ')) * sin(radians(latitude)))) AS distance FROM business_listings) AS distances WHERE distance < ' . $max_distance . ' ORDER BY distance');        
       }
       return view('home.main_search', compact('businesses', 'formattedAddress', 'parameter', 'simpleAddress', 'resultcms', 'businessCMSdata'));                   
    }

    public function sendBusinessDirections(Request $request)
    {
       $business = BusinessListing::find($request->id);
       $location = GeoIP::getLocation();
       $user_lat = $location->lat;
       $user_lng = $location->lon;
       $businessDirectionLink = 'https://www.google.com/maps/dir/'.$user_lat.','.$user_lng.'/'.$request->latitude.','.$request->longitude.'';

       //Sending-Business-Directions
       \Mail::to($request->email)->send(new BusinessDirectionsMail($business, $businessDirectionLink));
       return redirect()->back()->withSuccess('Business Direction has been sent to your email successfuly');
    } 

    public function love_business(Request $request)
    {
            if(Session::has('love') && $request->id == $request->session()->get('businessId')){
              return response(['msg' => 'Business has been already loved by you.', 'status' => 'repeated']);                
            }else{
              Session::put('love', 'exist');
              Session::put('businessId', $request->id);
              $businessLove = BusinessListing::find($request->id);
              $addLove = $businessLove->love + 1;
              $request['love'] = $addLove;
              $businessLove->update($request->all());
              return response(['msg' => 'Business has been loved successfully.', 'status' => 'success']);    
            }   
    }


    public function uploads(Request $request)
    {

      $CKEditor = $request->CKEditor;
      $funcNum = $request->CKEditorFuncNum;
      $message = $url = '';
      if ($request->hasFile('upload')) {
          $avatar = $request->file('upload');

            $filename = time() . '.' . $avatar->getClientOriginalName();
            $path = '/uploads/ckeditor/' . $filename;
            Image::make($avatar)->save( public_path($path));



      } else {
          $message = 'No file uploaded.';
      }
      return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$path.'", "'.$message.'")</script>';

    }




    #Protected Functions
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
