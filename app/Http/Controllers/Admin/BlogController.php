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
use App\BlogContributor;
use App\Blog;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Image;
use File;

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

    public function search(Request $request)
    {
           $search_parameter = $request->search_parameter;
           if($search_parameter != "")
           {

            $filterCategories = BlogCategory::where ( 'name', 'LIKE', '%' . $search_parameter . '%' )->paginate (10)->setPath ( '' );
            $pagination = $filterCategories->appends ( array (
                  'search_parameter' => $request->search_parameter 
              ) );
              
            if (count ( $filterCategories ) > 0)
            return view ( 'admin.blogs.blog_categories.listing_categories' )->withDetails ( $filterCategories )->withQuery ( $search_parameter );
           }

            return view ( 'admin.blogs.blog_categories.listing_categories' )->withMessage ( 'No Details found. Try to search again !' );
    }    

    public function listingCategories()
    {
      $blogCategories = BlogCategory::paginate(10);
      return view('admin.blogs.blog_categories.listing_categories', compact('blogCategories'));
    }

    public function new_category()
    {
    	return view('admin.blogs.blog_categories.new_category');
    }


    public function store_category(Request $request)
    {
    	 //Validating-Category-Data
           $validatedData = $request->validate([
        	  'name'         => 'required|string',
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
    	return view('admin.blogs.blog_categories.edit_blog_category_form', ['category' => $category]);    
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
       return view('admin.blogs.blog_categories.show_blog_category', ['category' => $category]);
    }


    public function listingContributors()
    {
      $blogContributors = BlogContributor::paginate(10);
      return view('admin.blogs.blog_contributors.listing_contributors', compact('blogContributors'));
    }   


    public function update_blog_contributor_status(Request $request)
    {
       if ( $request->input('id') ) 
       {
              $contributor = BlogContributor::find($request->input('id'));

              if($contributor->status == false)
              {
                $contributor->status  = true;
                $contributor->save();
                return response(['msg' => 'Blog Contributor status has been activated successfully', 'status' => 'success']); 
                
              }else{
                $contributor->status  = false;
                $contributor->save();
                return response(['msg' => 'Blog Contributor status has been deactivated successfully', 'status' => 'declined']); 
              } 
       }

       return response(['msg' => 'Failed changing the status of blog contributor', 'status' => 'failed']);
    }

    public function destroy_contributor(Request $request)
    {
      if ( $request->input('id') ) 
      {
            $contributor = BlogContributor::find($request->input('id'));
            $contributor->delete();
            return response(['msg' => 'Blog Contributor has been deleted successfully', 'status' => 'success']);
        }

            return response(['msg' => 'Failed deleting the blog contributor', 'status' => 'failed']);      
    }    

    public function new_contributor()
    {
      return view('admin.blogs.blog_contributors.new_contributor');
    }


    public function store_contributor(Request $request)
    {
       //Validating-Category-Data
           $validatedData = $request->validate([
            'title'         => 'required|string',
           ]);

          //Storing-Data
        $blog_contributor = new BlogContributor($request->all());
        $blog_contributor->save();

         return redirect()->route('admin.listingContributors')
                        ->with("success","Blog Contributor has been added successfully");                                  
    } 


    public function edit_contributor($slug)
    {
      $contributor = BlogContributor::findBySlugOrFail($slug);
      return view('admin.blogs.blog_contributors.edit_contributor', ['contributor' => $contributor]);    
    }


    public function update_contributor(Request $request, $slug)
    {
        $contributor = BlogContributor::findBySlugOrFail($slug);

            //Validating-Category-Data
        $validatedData = $request->validate([
              'title'         => 'required|string|max:255',
            ]);

            //Updating Category
            $contributor->update($request->all());

            Session::flash('success', 'Blog Contributor has been updated.');
            
            return redirect()->route('admin.listingContributors');                      

    }  


    public function show_contributor($slug)
    {
       $contributor = BlogContributor::findBySlugOrFail($slug);
       return view('admin.blogs.blog_contributors.show_contributor', ['contributor' => $contributor]);
    }    

    public function searchContributor(Request $request)
    {
           $search_parameter = $request->search_parameter;
           if($search_parameter != "")
           {

            $filterCategories = BlogContributor::where ( 'title', 'LIKE', '%' . $search_parameter . '%' )->paginate (10)->setPath ( '' );
            $pagination = $filterCategories->appends ( array (
                  'search_parameter' => $request->search_parameter 
              ) );
              
            if (count ( $filterCategories ) > 0)
            return view ( 'admin.blogs.blog_contributors.listing_contributors' )->withDetails ( $filterCategories )->withQuery ( $search_parameter );
           }

            return view ( 'admin.blogs.blog_contributors.listing_contributors' )->withMessage ( 'No Details found. Try to search again !' );
    }     


    public function listingBlogs()
    {
      $blogs = Blog::orderBy('id', 'desc')->paginate(10);
      return view('admin.blogs.listingBlogs', compact('blogs'));  
    }  

    public function update_blog_status(Request $request)
    {
       if ( $request->input('id') ) 
       {
              $blog = Blog::find($request->input('id'));

              if($blog->status == false)
              {
                $blog->status  = true;
                $blog->save();
                return response(['msg' => 'Blog status has been activated successfully', 'status' => 'success']); 
                
              }else{
                $blog->status  = false;
                $blog->save();
                return response(['msg' => 'Blog status has been deactivated successfully', 'status' => 'declined']); 
              } 
       }

       return response(['msg' => 'Failed changing the status of blog', 'status' => 'failed']);
    }    


    public function destroy_blog(Request $request)
    {
      if ( $request->input('id') ) 
      {
            $blog = Blog::find($request->input('id'));
            if($blog->avatar != 'default.png')
            {
              $path = '/uploads/blogavatars/' . $blog->avatar;
              unlink(public_path() . $path);
            }            
            $blog->delete();
            return response(['msg' => 'Blog has been deleted successfully', 'status' => 'success']);
        }

            return response(['msg' => 'Failed deleting the blog', 'status' => 'failed']);      
    } 

    public function searchBlog(Request $request)
    {
           $search_parameter = $request->search_parameter;
           if($search_parameter != "")
           {

            $filterCategories = Blog::where ( 'title', 'LIKE', '%' . $search_parameter . '%' )->paginate (10)->setPath ( '' );
            $pagination = $filterCategories->appends ( array (
                  'search_parameter' => $request->search_parameter 
              ) );
              
            if (count ( $filterCategories ) > 0)
            return view ( 'admin.blogs.listingBlogs' )->withDetails ( $filterCategories )->withQuery ( $search_parameter );
           }

            return view ( 'admin.blogs.listingBlogs' )->withMessage ( 'No Details found. Try to search again !' );
    }

    public function new_blog()
    {
      $blogcategories = BlogCategory::orderBy('id', 'desc')->get();
      $blogcontributors = BlogContributor::orderBy('id', 'desc')->get();
      return view('admin.blogs.new_blog', compact('blogcategories', 'blogcontributors'));
    }

    public function show_blog($slug)
    {
       $blog = Blog::findBySlugOrFail($slug);
       return view('admin.blogs.show_blog', compact('blog'));
    }   

    public function store_blog(Request $request)
    {
       //Validating-Category-Data
           $validatedData = $request->validate([
          'title'         => 'required|string',
          'metatitle'     => 'required|string',
          'metakeywords'  => 'required',
          'metadescription'     => 'required',
          'description'   => 'required',
          'avatar'       => 'unique:blogs'
           ]);


        //Storing-Data
        $blog = new Blog($request->all());
        $blog->save();
         if($request->hasFile('avatar'))
         {   
             $avatar = $request->file('avatar');
          
             //Using Helper/helpers.php
             uploadBlogAvatar($avatar, $blog);
         }
              

         return redirect()->route('admin.listingBlogs')
                        ->with("success","Blog has been added successfully"); 
    }     


    public function edit_blog($slug)
    {
      $blogcategories = BlogCategory::orderBy('id', 'desc')->get();
      $blogcontributors = BlogContributor::orderBy('id', 'desc')->get();
      $blog = Blog::findBySlugOrFail($slug);
      return view('admin.blogs.edit_blog', compact('blogcategories', 'blog', 'blogcontributors'));
    }

    public function update_blog(Request $request, $slug)
    {
        $blog = Blog::findBySlugOrFail($slug);
        $formatdate = Carbon::parse($request->created_at)->format('Y-m-d');
        $request['created_at'] = $formatdate;        
        $previousImage = $blog->avatar;

       //Validating-Category-Data
           $validatedData = $request->validate([
          'title'         => 'required|string',
          'metatitle'     => 'required|string',
          'metakeywords'  => 'required',
          'metadescription'     => 'required',
          'description'   => 'required',
          'avatar'       => 'unique:blogs'
           ]);

            //Updating Category
            $blog->update($request->all());

            if($request->hasFile('avatar'))
            {   
              $blogImage = public_path("uploads/blogavatars/{$previousImage}"); // get previous image from folder
              if (File::exists($blogImage)) { // unlink or remove previous image from folder
              unlink($blogImage);
              }            
               $avatar = $request->file('avatar');
           
               //Using Helper/helpers.php
               uploadBlogAvatar($avatar, $blog);
            } 

            Session::flash('success', 'Blog has been updated successfully.');
            
            return redirect()->route('admin.listingBlogs');  
    }         
}
