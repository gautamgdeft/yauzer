<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Yauzer;
use App\BusinessListing;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class BusinessYauzerController extends Controller
{
   public function __construct()
   {
	 $this->middleware('auth:admin');
   }

   public function new_yauzer($slug)
   {
   	$business = BusinessListing::findBySlugOrFail($slug);
   	return view ( 'admin.business_listing.partials.business_yauzers.new_yauzer_form', compact('slug','business') );
   }

   public function store_yauzer(Request $request, $slug)
   {
       #Validating-Fields
       $validatedData = $request->validate([
            'business_id'       => 'required|numeric',
            'user_id'           => 'required|numeric',
            'yauzer'            => 'required|string',
            'rating'            => 'required|numeric',
        ]);

       #Storing-Yauzers
       $user = new Yauzer($request->all());
       $user->save();

       if($yauzer->count() == '15'){
        #Premium-Business-Notification-Email-Admin
        \Mail::to('teamphp00@gmail.com')->send(new PremiumBusinessAdminEmail($yauzer->business));
       }       

      $route = 'admin/edit-business/'.$slug.'/#parentHorizontalTab7';
      return redirect($route)->with("success","Yauzer has been added successfuly");

      #return redirect()->route('admin.show_edit_business_form', ['slug' => $slug])->with("success","Yauzer has been added successfuly");     	   
   }


   public function destory_yauzer(Request $request)
   {
    	 if ( $request->input('id') ) 
    	 {
            $yauzer = Yauzer::find($request->input('id'));
            Yauzer::delete_yauzer($yauzer);
            return response(['msg' => 'Yauzer has been deleted successfully', 'status' => 'success']);
         }

            return response(['msg' => 'Failed deleting the yauzer', 'status' => 'failed']);
   }

   public function edit_yauzer($yauzer_id, $slug)
   {
       $business = BusinessListing::findBySlugOrFail($slug);
       $yauzer = Yauzer::find($yauzer_id);
       return view ( 'admin.business_listing.partials.business_yauzers.edit_yauzer', compact('slug','business', 'yauzer') );
   }

   public function update_yauzer($yauzer_id, $slug, Request $request)
   {
           $yauzer = Yauzer::find($yauzer_id);

	       #Validating-Fields
	       $validatedData = $request->validate([
	            'business_id'       => 'required|numeric',
	            'user_id'           => 'required|numeric',
	            'yauzer'            => 'required|string',
	            'rating'            => 'required|numeric',
	        ]);

            $yauzer->update($request->all());

      $route = 'admin/edit-business/'.$slug.'/#parentHorizontalTab7';
      return redirect($route)->with("success","Yauzer has been updated successfully");
			#Session::flash('success', 'Yauzer has been updated.');
            #return redirect()->route('admin.show_edit_business_form',['slug' => $slug]);      
   } 
}
