<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use App\BlogCategory;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function listingCategories()
    {
      $blogCategories = BlogCategory::paginate(10);
      return view('admin.blogs.listing_categories', compact('blogCategories'));
    }

    public function new_category()
    {
    	return view('admin.blogs.new_category');
    }


    public function store_category(Request $request)
    {
    	 //Validating-Category-Data
           $validatedData = $request->validate([
        	'name'         => 'required|string|max:255',
           ]);

	        //Storing-Data
    		$blog_category = new BlogCategory($request->all());
            $blog_category->save();

         return redirect()->route('admin.listingCategories')
                        ->with("success","Blog Category has been added successfully");                                  
    }    


    public function edit_category($slug)
    {
    	$category = BlogCategory::findBySlugOrFail($slug);
    	return view('admin.blogs.edit_blog_category_form', ['category' => $category]);    
    }


    public function update_category(Request $request, $slug)
    {
        $category = BlogCategory::findBySlugOrFail($slug);

            //Validating-Category-Data
    		$validatedData = $request->validate([
		        	'name'         => 'required|string|max:255',
            ]);

            //Updating Category
            $category->update($request->all());

            Session::flash('success', 'Blog Category has been updated.');
            
            return redirect()->route('admin.listingCategories');                      

    }     

    public function update_blog_category_status(Request $request)
    {
    	 if ( $request->input('id') ) 
    	 {
              $category = BlogCategory::find($request->input('id'));

              if($category->status == false)
              {
              	$category->status  = true;
              	$category->save();
              	return response(['msg' => 'Blog Category status has been activated successfully', 'status' => 'success']); 
              	
              }else{
              	$category->status  = false;
              	$category->save();
              	return response(['msg' => 'Blog Category status has been deactivated successfully', 'status' => 'declined']); 
              }	
    	 }

    	 return response(['msg' => 'Failed changing the status of blog category', 'status' => 'failed']);
    }


    public function destroy_category(Request $request)
    {
    	if ( $request->input('id') ) 
    	{
            $category = BlogCategory::find($request->input('id'));
            $category->delete();
            return response(['msg' => 'Blog Category has been deleted successfully', 'status' => 'success']);
        }

            return response(['msg' => 'Failed deleting the blog category', 'status' => 'failed']);    	
    }

    public function show_category($slug)
    {
       $category = BlogCategory::findBySlugOrFail($slug);
       return view('admin.blogs.show_blog_category', ['category' => $category]);
    }        
}
