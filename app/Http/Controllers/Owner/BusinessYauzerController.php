<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Yauzer;
use App\BusinessListing;
use App\YauzerComment;
use App\SiteCms;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class BusinessYauzerController extends Controller
{
    public function index()
    {
        $socialShareCms = SiteCms::where('slug', 'social-share-messages')->first();
    	$business = Auth::user()->business; 
    	$businessYauzersInfo = Yauzer::orderBy('id', 'desc')->where('business_id', Auth::user()->business->id)->get();
    	$yauzerComments = YauzerComment::orderBy('id', 'desc')->where('business_id', Auth::user()->business->id)->get();
    	return view ( 'owner.business_yauzers.index', compact('businessYauzersInfo','business', 'socialShareCms') );
    }

    public function respondYauzer(Request $request)
    {
    	$businessYauzerInfo =  YauzerComment::updateOrCreate(['yauzer_id' => $request->yauzer_id], $request->all());
    	return redirect()->route('owner.yauzers')->with("success","Business Yauzer has been updated successfully");
    }
}
