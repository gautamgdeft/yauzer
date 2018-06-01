<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SliderImage;
use App\BusinessCategory;
use App\BusinessListing;
use App\SiteCms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use GeoIP;
use App\Blog;
use Carbon\Carbon;
use Geocoder\Laravel\Facades\Geocoder;
use Session;

class WelcomeController extends Controller
{

    public function checkuser()
    {
        if(Auth::user()->isUser())
        {
            return redirect()->route('user.yauzer_business');
        }else{

            $checkClaimedBusiness = BusinessListing::checkClaimedBusiness(Auth::user()->id);
            
            if(sizeof($checkClaimedBusiness)){
             return redirect()->route('owner.dashboard');
            }else{
             return redirect()->route('owner.yauzer_business');    
            }
        }
    }

    public function index()
    {   
        #Getting-Lat-Lng-Of-User
        #$location = GeoIP::getLocation();
        #Getting Full Address From Location Geocoder
        #$data = Geocoder::reverse($location->lat, $location->lon)->all();
        #$formattedAddress = $data[0]->getformattedAddress();
        $sliderImages = SliderImage::orderBy('id', 'desc')->get();
        $businessCategory = BusinessCategory::where('status', '1')->get();
        $businesses = BusinessListing::withCount('yauzers')->orderBy('yauzers_count', 'desc')->where('premium_status', true)->take(8)->get();
        $blogs = Blog::orderBy('id', 'desc')->get();
        $businessCMSdata = SiteCms::where('slug', 'business')->first();
        return view('home.welcome', compact('sliderImages','businessCategory', 'businesses', 'blogs', 'homeCMSdata', 'businessCMSdata'));
    }


}
