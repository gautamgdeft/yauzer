<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\BusinessListing;
use App\BusinessPicture;

class BusinessPictureController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $business = $user->business;    	
    	$businessPictures = BusinessPicture::where('business_id', $business->id)->get();
    	return view('owner.pictures_videos.index', compact('businessPictures'));
    }

    public function new_picture($slug)
    {
       return view('owner.pictures_videos.new_picture', compact('slug'));
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

	      
        return redirect()->route('owner.pictures_videos')
                        ->with("success","Picture has been addedd successfully");     

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
