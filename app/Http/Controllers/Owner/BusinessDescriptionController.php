<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\BusinessListing;


class BusinessDescriptionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $business = $user->business;    	
    	  return view('owner.biz_description.index', compact('business'));
    }

    public function edit_description_form(Request $request, $slug)
    {
	  $businessListing = BusinessListing::findBySlugOrFail($slug);
 	  return view('owner.biz_description.edit_description_form', ['businessListing' => $businessListing, 'slug' => $slug]);    	 
	}   

    public function update_business_description(Request $request, $slug)
    {
      $businessListing = BusinessListing::findBySlugOrFail($slug);
      $businessListing->description = $request->description;
      $businessListing->update();
      
      $route = 'admin/edit-business/'.$slug.'/#parentHorizontalTab4';
      return redirect()->route('owner.biz_description')->with("success","Business Description has been updated successfully");
    }	 
}
