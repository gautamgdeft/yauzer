<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Yauzer;

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
    	return view('owner.dashboard.home', compact('yauzers'));
    }


    public function unautorize_access()
    {
        if(Auth::user()->business->yauzers->count() < 15){
        return redirect()->route('owner.dashboard')->withError('Business must contain maximum 15 yauzers and payment informaton to access all these options');
        }else{

        return redirect()->route('owner.payment_information')->withError('Enter Payment information to access this option');            
        }
    }
}
