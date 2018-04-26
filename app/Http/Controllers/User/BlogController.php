<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Blog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Session;

class BlogController extends Controller
{
      public function showBlogs()
      {
        #$set = Session::put('love', 'sammy');
        #$value = Session::get('love');

      	$blogs = Blog::orderBy('id', 'desc')->paginate(10);

		    $categoriesGroupedBlogs = Blog::join('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
         ->select('blog_categories.id', 'blog_categories.name', DB::raw('COUNT(*) AS total'))
         ->groupBy('blog_categories.id')
         ->groupBy('blog_categories.name')
         ->get();


    		// $monthlysales=DB::table('blogs')
        //    ->select('created_at', DB::raw('COUNT(*) AS total'))
        //    ->groupBy('created_at')
        //    ->orderBy('created_at','desc')
        //   ->get();
        //        dd($monthlysales);

      	
      	return view('home.blogs.showBlogs', compact('blogs', 'categoriesGroupedBlogs'));
      }


      public function showsingleBlogDetail($slug)
      {
      	 $blogs = Blog::orderBy('id', 'desc')->get();
         $singleBlog = Blog::findBySlugOrFail($slug);
		     $categoriesGroupedBlogs = Blog::join('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
         ->select('blog_categories.id', 'blog_categories.name', DB::raw('COUNT(*) AS total'))
         ->groupBy('blog_categories.id')
         ->groupBy('blog_categories.name')
         ->get();         
         return view('home.blogs.showDetailBlog', compact('singleBlog', 'blogs', 'categoriesGroupedBlogs'));
      }


      public function categoryfilterBlogs($id)
      {
		     $categoriesGroupedBlogs = Blog::join('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
         ->select('blog_categories.id', 'blog_categories.name', DB::raw('COUNT(*) AS total'))
         ->groupBy('blog_categories.id')
         ->groupBy('blog_categories.name')
         ->get();               	
           $blogs = Blog::where('blog_category_id', $id)->get();
           return view('home.blogs.showBlogs', compact('blogs', 'categoriesGroupedBlogs'));
      }
}
