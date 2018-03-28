<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\BusinessInfo;
use App\BusinessMoreInfo;
use Image;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class BusinessInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function search(Request $request)
    {
           $search_parameter = $request->search_parameter;

           if($search_parameter != "")
           {

            $filterInfo = BusinessInfo::where ( 'name', 'LIKE', '%' . $search_parameter . '%' )->paginate (10)->setPath ( '' );
            $pagination = $filterInfo->appends ( array (
                  'search_parameter' => $request->search_parameter 
              ) );
              
            if (count ( $filterInfo ) > 0)
            return view ( 'admin.business_info.listing' )->withDetails ( $filterInfo )->withQuery ( $search_parameter );
           }

            return view ( 'admin.business_info.listing' )->withMessage ( 'No Details found. Try to search again !' )->withQuery ( $request->search_parameter );
    }      

    public function show_listing()
    {
    	$businessInfo = BusinessInfo::orderBy('id', 'desc')->where('user_id', 0)->paginate(10); 
    	return view('admin.business_info.listing', compact('businessInfo'))->withQuery ('');
    }

    public function add_more_info()
    {
    	return view('admin.business_info.add_more_info');
    }

    public function store_business_info(Request $request)
    {
        //Validation-Working-Starts
        $validatedData = $request->validate([
        	'name'            => 'required|string',
            'user_id'         => 'required|numeric',
        ]);

        $morInfo = new BusinessInfo($request->all());
        $morInfo->save();

        return redirect()->route('business.more_info_listing')->with("success","Info has been added successfuly");        
    }

    public function update_info_status(Request $request)
    {
    	 if ( $request->input('id') ) 
    	 {
              $info = BusinessInfo::find($request->input('id'));

              if($info->status == false)
              {
              	$info->status  = true;
              	$info->save();
              	return response(['msg' => 'Business Info status has been activated successfully', 'status' => 'success']); 
              	
              }else{
              	$info->status  = false;
              	$info->save();
              	return response(['msg' => 'Business Info status has been deactivated successfully', 'status' => 'declined']); 
              }	
    	 }

    	 return response(['msg' => 'Failed changing the status of business info', 'status' => 'failed']);
    }

    public function destroy_business_info(Request $request)
    {
    	if ( $request->input('id') ) 
    	{
            $info = BusinessInfo::find($request->input('id'));
            $info->delete();
            return response(['msg' => 'Business Info has been deleted successfully', 'status' => 'success']);
        }
            return response(['msg' => 'Failed deleting the business info', 'status' => 'failed']);    	
    }

    public function edit_business_info($slug)
    {
    	$businessInfo = BusinessInfo::findBySlugOrFail($slug);
    	return view('admin.business_info.edit_business_info', compact('businessInfo')); 
    }

    public function update_business_info(Request $request, $slug)
    {
        //Validation-Working-Starts
        $validatedData = $request->validate([
        	'name'            => 'required|string',
        ]);    	
        
        $businessInfo = BusinessInfo::findBySlugOrFail($slug);
        $businessInfo->update($request->all());
        return redirect()->route('business.more_info_listing')->with("success","Info has been updated successfuly");
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

        $route = 'admin/edit-business/'.$slug.'/#parentHorizontalTab9';
        return redirect($route)->with("success","Business More Info has been updated successfuly"); 
        #return redirect()->route('admin.show_edit_business_form', ['slug' => $slug])->with("success"," Business More Info has been updated successfuly");

        
    }
}
