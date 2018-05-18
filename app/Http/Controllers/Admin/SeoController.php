<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use App\SiteSeo;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Image;
use File;

class SeoController extends Controller
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

    public function index()
    {
	  $siteseo = SiteSeo::paginate(10);
	  return view('admin.site_seo.index', compact('siteseo'));    	
    }

    public function edit_seo($slug)
    {
       $siteseo = SiteSeo::where('slug', $slug)->first();
       return view('admin.site_seo.edit_seo', compact('siteseo'));    	
    }

    public function update_seo(Request $request, $slug)
    {
        $siteseo = SiteSeo::where('slug', $slug)->first();
	    //Updating Seo
	    $siteseo->update($request->all());

	    Session::flash('success', 'Seo Page has been updated.');
	    
	    return redirect()->route('admin.listingseo');          
    }

    public function show_seo($slug)
    {
	   $siteseo = SiteSeo::where('slug', $slug)->first();
       return view('admin.site_seo.show_seo', compact('siteseo'));    	
    }

}
