<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\BusinessCategory;
use Image;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class BusinessCategoryController extends Controller
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

            $filterCategories = BusinessCategory::where ( 'name', 'LIKE', '%' . $search_parameter . '%' )->paginate (10)->setPath ( '' );
            $pagination = $filterCategories->appends ( array (
                  'search_parameter' => $request->search_parameter 
              ) );
              
            if (count ( $filterCategories ) > 0)
            return view ( 'admin.business_category.listing' )->withDetails ( $filterCategories )->withQuery ( $search_parameter );
           }

            return view ( 'admin.business_category.listing' )->withMessage ( 'No Details found. Try to search again !' );
    }  


    public function business_category_listing()
    {
       $business_categories = BusinessCategory::orderBy('id', 'desc')->paginate(10);
       return view('admin.business_category.listing', ['business_categories' => $business_categories]);
    }


    public function new_category()
    {
    	return view('admin.business_category.new_category');
    }


    public function store_category(Request $request)
    {
    	 //Validating-Category-Data
           $validatedData = $request->validate([
        	  'name'         => 'required|string|max:255',
            'avatar'       => 'unique:business_categories'
           ]);


	     //Storing-Data
    		$business_category = BusinessCategory::create(
	              array(
	                   'name'          => $request->input('name'),                  
                       ));

	      $business_category->save();
        
         //Saving Category Avatar
           if($request->hasFile('avatar'))
            {   
              $avatar = $request->file('avatar');

              //Using Helper/helpers.php
              uploadBusinessAvatar($avatar, $business_category);
	          }

         return redirect()->route('admin.business_category_listing')
                        ->with("success","Business Category has been added successfully");                                  
    }


    public function edit_category($slug)
    {
    	$category = BusinessCategory::findBySlugOrFail($slug);
    	return view('admin.business_category.edit_category_form', ['category' => $category]);    
    }


    public function update_category(Request $request, $slug)
    {
        $category = BusinessCategory::findBySlugOrFail($slug);

            //Validating-Category-Data
    		$validatedData = $request->validate([
		        	'name'         => 'required|string|max:255',
		          'avatar'       => 'unique:business_categories'
            ]);

            //Updating Category
            $category->update($request->all());

            if($request->hasFile('avatar'))
            {   
               $avatar = $request->file('avatar');
           
               //Using Helper/helpers.php
               uploadBusinessAvatar($avatar, $category);
            } 

			      Session::flash('success', 'Business Category has been updated.');
            
            return redirect()->route('admin.business_category_listing');                      

    } 


    public function destroy_category(Request $request)
    {
    	if ( $request->input('id') ) 
    	{
            $category = BusinessCategory::find($request->input('id'));
           
            if($category->avatar != 'default.png')
            {
              $path = '/uploads/categoryAvatars/' . $category->avatar;
              unlink(public_path() . $path);
            }
            $category->delete();
            return response(['msg' => 'Business Category has been deleted successfully', 'status' => 'success']);
        }

            return response(['msg' => 'Failed deleting the business category', 'status' => 'failed']);
    }


    public function update_category_status(Request $request)
    {
    	 if ( $request->input('id') ) 
    	 {
              $category = BusinessCategory::find($request->input('id'));

              if($category->status == false)
              {
              	$category->status  = true;
              	$category->save();
              	return response(['msg' => 'Business Category status has been activated successfully', 'status' => 'success']); 
              	
              }else{
              	$category->status  = false;
              	$category->save();
              	return response(['msg' => 'Business Category status has been deactivated successfully', 'status' => 'declined']); 
              }	
    	 }

    	 return response(['msg' => 'Failed changing the status of business category', 'status' => 'failed']);    	
    }

    public function show_category($slug)
    {
       $category = BusinessCategory::findBySlugOrFail($slug);
       return view('admin.business_category.show_category', ['category' => $category]);
    }               
}
