<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\BusinessInfo;
use App\BusinessMoreInfo;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class BusinessMoreinfoController extends Controller
{
   public function index()
   {
       //Pedefined Business-Info-Admin
       $businessInfo = BusinessInfo::where('status', true)->where('user_id', 0)->orWhere('user_id', Auth::user()->id)->get();
       $existing_db_business_info = BusinessMoreInfo::where('business_id', Auth::user()->business->id)->pluck('business_info_id')->toArray();
       $business = Auth::user()->business;
       return view('owner.business_more_info.listing', compact('businessInfo', 'existing_db_business_info', 'business'));
   }

    public function update_main_info(Request $request, $slug)
    {

     //Now-Updating-in-Business-More-Infos
        
      BusinessMoreInfo::where('business_id', $request->business_id)->delete();
        
      foreach ($request->name as $looping_more_info) {
       
       $request['business_info_id'] = $looping_more_info;
       $businessMoreInfo =  BusinessMoreInfo::updateOrCreate(['business_id' => $request->business_id, 'business_info_id' => $looping_more_info], $request->all());
      }
       
      //Adding-in-Business-Info 
       if(@sizeof($request->businessInfo[0])){

         $request['businessInfo'] = explode(',', $request->businessInfo[0]);
          foreach ($request->businessInfo as $looping_Infos) {
            $morInfo = new BusinessInfo();
            $morInfo->name = $looping_Infos;
            $morInfo->user_id = $request->user_id;
            $morInfo->save();

          $request['business_info_id'] = $morInfo->id;  
          $businessMoreInfo =  BusinessMoreInfo::updateOrCreate(['business_id' => $request->business_id, 'business_info_id' => $morInfo->id], $request->all());  
          }
        }

        return redirect()->route('owner.biz_more_info')->with("success"," Business More Info has been updated successfuly");

        
    }   
}
