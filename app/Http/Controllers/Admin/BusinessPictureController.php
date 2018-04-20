<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BusinessListing;
use App\BusinessPicture;

class BusinessPictureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


	public function new_picture($slug)
    {
       return view('admin.business_listing.partials.business_pictures.new_picture', compact('slug'));
    }

    public function store_picture(Request $request, $slug)
    {
       #Validating-Fields
       $validatedData = $request->validate([
            'avatar'            => 'image:jpg,png,jpeg,gif|unique:business_pictures'
        ]);

       $businessListing = BusinessListing::findBySlugOrFail($slug);

   	     //Storing-Data
		        $business_picture = BusinessPicture::create(
              array(
                   'business_id'          => $businessListing->id,
                   'avatar'               => 'default.png'                  
                   ));

         //Saving Business Picture Avatar
	         if($request->hasFile('avatar'))
	          {   
	            $avatar = $request->file('avatar');

	            //Using Helper/helpers.php
	            uploadBusinessPicturesAvatar($avatar, $business_picture);
	            $business_picture->save();
	          }

        $route = 'admin/edit-premium-business/'.$slug.'/#parentHorizontalTab3';
        return redirect($route)->with("success","Picture has been addedd successfully");
	      
        //return redirect()->route('admin.show_edit_business_form', compact('slug'))
                        //->with("success","Picture has been addedd successfully");     

    }

    public function destroy_picture(Request $request)
    {
    	if ( $request->input('id') ) 
    	{
            $businessPicture = BusinessPicture::find($request->input('id'));
              $path = '/uploads/businessAvatars/' . $businessPicture->avatar;
              unlink(public_path() . $path);
            
            $businessPicture->delete();
            return response(['msg' => 'Picture has been deleted successfully', 'status' => 'success']);
      }
            return response(['msg' => 'Failed deleting the picture', 'status' => 'failed']); 
    }

    


}

