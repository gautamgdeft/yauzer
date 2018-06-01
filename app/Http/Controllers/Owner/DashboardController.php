<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Yauzer;
use App\Pricing;
use App\SiteCms;

class DashboardController extends Controller
{
    public function index()
    {
    	$yauzers = []; 
    	if(@sizeof(Auth::user()->businesses)){
          foreach(Auth::user()->businesses as $loopingbusiness){
          	$yauzers['yauzers'] = $loopingbusiness->yauzers;
          }
    	}else{
    		    $yauzers['yauzers'] = NULL;
    	}
        $ownerHeadercms = SiteCms::where('slug', 'owner-dashboard-header')->first();
        $ownerBasicListingcms  = SiteCms::where('slug', 'owner-dashboard-basic-listing')->first();
        $ownerPricingStructurecms  = SiteCms::where('slug', 'owner-pricing-structure')->first();
        $ownerPremiumListingcms = SiteCms::where('slug', 'owner-dashboard-premium-listing')->first();
        $socialShareCms = SiteCms::where('slug', 'social-share-messages')->first();
    	return view('owner.dashboard.home', compact('yauzers','ownerHeadercms','ownerBasicListingcms', 'ownerPricingStructurecms', 'ownerPremiumListingcms', 'socialShareCms'));
    }


    public function unautorize_access()
    {
        $plans = Pricing::where('type', 'price')->pluck('yauzer');
        if(Auth::user()->business->yauzers->count() < $plans[0]){
        return redirect()->route('owner.dashboard')->withError('Business must contain maximum '.$plans[0].' yauzers and payment informaton to access all these options');
        }else{

        return redirect()->route('owner.payment_information')->withError('Enter Payment information to access this option');            
        }
    }
}
