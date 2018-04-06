<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\BusinessListing;
use App\Speciality;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class BusinessSpecialityController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
        $business = $user->business; 
    	$businessSpecialitiesInfo = Speciality::orderBy('id', 'desc')->where('business_id', $business->id)->get();
    	return view('owner.biz_speciality.index', compact('business','businessSpecialitiesInfo'));
    }

   public function new_speciality($slug)
   {
   	$business = BusinessListing::findBySlugOrFail($slug);
   	return view ( 'owner.biz_speciality.new_speciality_form', compact('slug','business') );
   }

   public function store_speciality(Request $request, $slug)
   {
       #Validating-Fields
       $validatedData = $request->validate([
            'business_id'       => 'required|numeric',
            'name'              => 'required|string',
        ]);

       #Storing-Yauzers
       $speciality = new Speciality($request->all());
       $speciality->save();

       return redirect()->route('owner.biz_specialties')->with("success","Speciality has been added successfuly");       
       
   }

   public function destory_speciality(Request $request)
   {
    	 if ( $request->input('id') ) 
    	 {
            $speciality = Speciality::find($request->input('id'));
            $speciality->delete();
            return response(['msg' => 'Speciality has been deleted successfully', 'status' => 'success']);
         }

            return response(['msg' => 'Failed deleting the special', 'status' => 'failed']);
   }

   public function edit_speciality($speciality_slug, $slug)
   {
       $business = BusinessListing::findBySlugOrFail($slug);
       $speciality = Speciality::findBySlugOrFail($speciality_slug);
       return view ( 'owner.biz_speciality.edit_speciality', compact('slug','business', 'speciality') );
   }

   public function update_speciality($speciality_slug, $slug, Request $request)
   {
           $speciality = Speciality::findBySlugOrFail($speciality_slug);

	       #Validating-Fields
	       $validatedData = $request->validate([
		            'business_id'       => 'required|numeric',
		            'name'              => 'required|string',
	        ]);

            $speciality->update($request->all());

         return redirect()->route('owner.biz_specialties')->with("success","Speciality has been updated successfuly");   
   }        
}
