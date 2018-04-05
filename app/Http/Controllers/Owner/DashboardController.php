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
}
