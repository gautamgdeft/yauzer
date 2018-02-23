<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\BusinessCategory;
use App\BusinessSubcategory;
use Image;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;


class BusinessSubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show_subcategory($slug)
    {
       $category = BusinessCategory::findBySlugOrFail($slug);
       $subcategory = $category->business_subcategory()->where('status', true)->get();
       return view('admin.business_subcategory.show_subcategory',compact('slug','subcategory'));	
    }

    public function new_subcategory($slug)
    {
       $category = BusinessCategory::findBySlugOrFail($slug);	
       return view('admin.business_subcategory.show_subcategory_form',compact('category','slug'));	
    }

    public function store_subcategory(Request $request, $slug)
    {

    	 //Validating-Category-Data
           $validatedData = $request->validate([
        	  'name'         => 'required|string|max:255',
              'avatar'       => 'unique:business_categories'
           ]);


	     //Storing-Data
    		$business_subcategory = BusinessSubcategory::create(
	              array(
	              	   'business_category_id' => $request->input('business_category_id'),
	                   'name'                 => $request->input('name'),                  
                       ));

         //Saving Category Avatar
	         if($request->hasFile('avatar'))
	          {   
	            $avatar = $request->file('avatar');

	            //Using Helper/helpers.php
	            uploadBusinessSubCatAvatar($avatar, $business_subcategory);
	            $business_subcategory->save();
	          }

         return redirect()->route('admin.show_subcategory',['slug' => $slug])
                        ->with("success","Business Sub-Category has been added successfuly");
    }

    public function update_subcategory_status(Request $request)
    {
    	 if ( $request->input('id') ) 
    	 {
              $subcategory = BusinessSubcategory::find($request->input('id'));

              if($subcategory->status == false)
              {
              	$subcategory->status  = true;
              	$subcategory->save();
              	return response(['msg' => 'Business Sub-Category status has been activated successfully', 'status' => 'success']); 
              	
              }else{
              	$subcategory->status  = false;
              	$subcategory->save();
              	return response(['msg' => 'Business Sub-Category status has been deactivated successfully', 'status' => 'declined']); 
              }	
    	 }

    	 return response(['msg' => 'Failed changing the status of business Sub-Category', 'status' => 'failed']);    	
    }

    public function destroy_subcategory(Request $request)
    {
    	if ( $request->input('id') ) 
    	{
            $subcategory = BusinessSubcategory::find($request->input('id'));
           
            if($subcategory->avatar != 'default.png')
            {
              $path = '/uploads/subcategoryAvatars/' . $subcategory->avatar;
              unlink(public_path() . $path);
            }
            $subcategory->delete();
            return response(['msg' => 'Business Sub-Category has been deleted successfully', 'status' => 'success']);
        }

            return response(['msg' => 'Failed deleting the business sub-category', 'status' => 'failed']);    	
    }

    public function edit_subcategory($slug)
    {
    	$subcategory = BusinessSubcategory::findBySlugOrFail($slug);
    	return view('admin.business_subcategory.edit_subcategory_form', compact('subcategory'));    
    }

    public function update_subcategory(Request $request, $slug)
    {
        $subcategory = BusinessSubcategory::findBySlugOrFail($slug);

            //Validating-Sub-Category-Data
    		$validatedData = $request->validate([
		        	'name'         => 'required|string|max:255',
		            'avatar'       => 'unique:business_categories'
            ]);

            //Updating Sub-Category
            $subcategory->update($request->all());

            if($request->hasFile('avatar'))
            {   
               $avatar = $request->file('avatar');
           
               //Using Helper/helpers.php
               uploadBusinessSubCatAvatar($avatar, $subcategory);
            } 

			Session::flash('success', 'Business Sub-Category was updated.');
            return redirect()->route('admin.show_subcategory', compact('slug'));          	
    }
}
