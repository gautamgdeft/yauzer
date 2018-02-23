<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Page;
use App\SliderImage;
use App\BusinessCategory;
use App\BusinessListing;
use App\HeaderMenu;
use App\FooterMenu;
use Image;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class ContentManagementController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }


  public function pages()
  {
   $pages = Page::all();		
   return view('admin.content_management.pages.page_listing',['pages' => $pages]);
 }


 public function show_page_form()
 {
   return view('admin.content_management.pages.show_page_form'); 	
 }


 public function store_page(Request $request)
 {
  $validatedData = $request->validate([
   'name'             => 'required|string|max:255',
   'description'      => 'required|string',
   'metatitle'        => 'required|string',
   'metakeywords'     => 'required|string',
   'metadescription' => 'required|string',
 ]);

  $name = str_slug($request->input('name'), "-");
  $site_url = url('/');
  $pageUrl = $site_url . '/' . $name;


           //Storing Page Info
  $page = Page::create(
   array(
    'name'             => $request->input('name'),
    'description'      => $request->input('description'),
    'metatitle'        => $request->input('metatitle'),
    'metakeywords'     => $request->input('metakeywords'),
    'metadescription'  => $request->input('metadescription'),
    'pageurl'          => $pageUrl,
  ));

  $page->save();

  return redirect()->route('admin.pages')
  ->with("success","Page has been added successfuly");    	   

}

public function update_page_status(Request $request)
{
  if ( $request->input('id') ) 
  {
    $page = Page::find($request->input('id'));

    if($page->status == false)
    {
     $page->status  = true;
     $page->save();
     return response(['msg' => 'Page status has been activated successfully', 'status' => 'success']); 

   }else{
     $page->status  = false;
     $page->save();
     return response(['msg' => 'Page status has been deactivated successfully', 'status' => 'declined']); 
   }	
 }

 return response(['msg' => 'Failed changing the status of page', 'status' => 'failed']);                    
}


public function destroy_page(Request $request)
{
 if ( $request->input('id') ) 
 {
  $page = Page::find($request->input('id'));
  $page->delete();
  return response(['msg' => 'Page has been deleted successfully', 'status' => 'success']);
}

return response(['msg' => 'Failed deleting the page', 'status' => 'failed']);
}


public function edit_page($slug)
{
  $page = Page::findBySlugOrFail($slug);
  return view('admin.content_management.pages.edit_page_form', ['page' => $page]);    	    	
}


public function update_page(Request $request, $slug)
{
 $page = Page::findBySlugOrFail($slug);

 $validatedData = $request->validate([
   'name'             => 'required|string|max:255',
   'description'      => 'required|string',
   'metatitle'        => 'required|string',
   'metakeywords'     => 'required|string',
   'metadescription' => 'required|string',
 ]);

 $page->update($request->all());
 Session::flash('success', 'Page was updated.');
 return redirect()->route('admin.pages');                          	
}


public function images()
{
    	#return view('admin.content_management.sliderimages.images');
}


public function sliderimages()
{
 $sliderImages = SliderImage::all();
 return view('admin.content_management.sliderimages.sliderimages',['sliderImages' => $sliderImages]);
}


public function new_slider_image()
{
 return view('admin.content_management.sliderimages.new_slider_image');

}


public function store_slider_image(Request $request)
{

  $validatedData = $request->validate([
    'image_alt_text' => 'required|string',
    'avatar'         => 'image:jpg,png,jpeg,gif|unique:sliderimages'
  ]);

        //Storing SliderImages
  $sliderImage = SliderImage::create(
   array(
    'image_alt_text' => $request->input('image_alt_text'),                  
  ));

         //Saving Slider-Image Avatar
  if($request->hasFile('avatar'))
  {   
    $avatar = $request->file('avatar');

            //Using Helper/helpers.php
    uploadSliderAvatar($avatar, $sliderImage);
    $sliderImage->save();
  }

  return redirect()->route('admin.sliderimages')
  ->with("success","Slider Image has been added successfuly");                          
}


public function destroy_slider_image(Request $request)
{
 if ( $request->input('id') ) 
 {
  $sliderImage = SliderImage::find($request->input('id'));
  if($sliderImage->avatar != 'default.png'){
    $path = '/uploads/sliderAvatars/' . $sliderImage->avatar;
    unlink(public_path() . $path);
  }            
  $sliderImage->delete();
  return response(['msg' => 'Slider Image has been deleted successfully', 'status' => 'success']);
}

return response(['msg' => 'Failed deleting the slider image', 'status' => 'failed']);
}


public function update_slider_image_status(Request $request)
{
 if ( $request->input('id') ) 
 {
  $sliderImage = SliderImage::find($request->input('id'));

  if($sliderImage->status == false)
  {
   $sliderImage->status  = true;
   $sliderImage->save();
   return response(['msg' => 'Slider image status has been activated successfully', 'status' => 'success']); 

 }else{
   $sliderImage->status  = false;
   $sliderImage->save();
   return response(['msg' => 'Slider image status has been deactivated successfully', 'status' => 'declined']); 
 }	
}

return response(['msg' => 'Failed changing the status of slider image', 'status' => 'failed']);    	
}


public function edit_slider_image($slug)
{
  $sliderImage = SliderImage::findBySlugOrFail($slug);
  return view('admin.content_management.sliderimages.edit_slider_image_form', ['sliderImage' => $sliderImage]);   
}


public function update_slider_image(Request $request, $slug)
{
 $sliderImage = SliderImage::findBySlugOrFail($slug);

 $validatedData = $request->validate([
   'image_alt_text' => 'required|string',
   'avatar'         => 'image:jpg,png,jpeg,gif|unique:sliderimages'
 ]);


 $sliderImage->image_alt_text = $request->input('image_alt_text');
 $sliderImage->save();

 if($request->hasFile('avatar'))
 {   
   $avatar = $request->file('avatar');

               //Using Helper/helpers.php
   uploadSliderAvatar($avatar, $sliderImage);

 } 

 Session::flash('success', 'Slider image was updated.');
 return redirect()->route('admin.sliderimages');                          	
}

public function headermenus()
{
  $headerMenus = HeaderMenu::all();
  return view('admin.content_management.header_menu.listing',compact('headerMenus'));  
}

public function show_header_menu_form()
{
  return view('admin.content_management.header_menu.show_header_menu_form');
}

public function store_header_menu(Request $request)
{
   $validatedData = $request->validate([
     'name'    => 'required|string',
     'url'     => 'required|url'
   ]);
  
  $headerMenu = new HeaderMenu;
  $headerMenu->name = $request->name;
  $headerMenu->url  = $request->url;

  $headerMenu->save();   

  return redirect()->route('admin.headermenus')
  ->with("success","Menu has been added successfuly"); 
}

public function update_header_menu_status(Request $request)
{
 if ( $request->input('id') ) 
 {
  $headerMenu = HeaderMenu::find($request->input('id'));

  if($headerMenu->status == false)
  {
   $headerMenu->status  = true;
   $headerMenu->save();
   return response(['msg' => 'Menu status has been activated successfully', 'status' => 'success']); 

 }else{
   $headerMenu->status  = false;
   $headerMenu->save();
   return response(['msg' => 'Menu status has been deactivated successfully', 'status' => 'declined']); 
 }  
}

}

public function destroy_header_menu(Request $request)
{
 if ( $request->input('id') ) 
 {
  $headerMenu = HeaderMenu::find($request->input('id'));         
  $headerMenu->delete();
  return response(['msg' => 'Menu has been deleted successfully', 'status' => 'success']);
}

return response(['msg' => 'Failed deleting the menu', 'status' => 'failed']);
}

public function edit_header_menu($slug)
{
    $headerMenu = HeaderMenu::findBySlugOrFail($slug);
    return view('admin.content_management.header_menu.edit_header_menu', compact('headerMenu'));
}

public function update_header_menu(Request $request, $slug)
{
 $headerMenu = HeaderMenu::findBySlugOrFail($slug);

 $validatedData = $request->validate([
     'name'    => 'required|string',
     'url'     => 'required|url'
 ]);


 $headerMenu->name = $request->input('name');
 $headerMenu->url  = $request->input('url');
 $headerMenu->save();

 Session::flash('success', 'Menu was updated.');
 return redirect()->route('admin.headermenus');                            
}

public function footermenus()
{
  $footerMenus = FooterMenu::all();
  return view('admin.content_management.footer_menu.listing',compact('footerMenus'));  
}

public function show_footer_menu_form()
{
  return view('admin.content_management.footer_menu.show_footer_menu_form');
}

public function store_footer_menu(Request $request)
{
   $validatedData = $request->validate([
     'name'    => 'required|string',
     'url'     => 'required|url'
   ]);
  
  $footerMenu = new FooterMenu;
  $footerMenu->name = $request->name;
  $footerMenu->url  = $request->url;

  $footerMenu->save();   

  return redirect()->route('admin.footermenus')
  ->with("success","Menu has been added successfuly"); 
}

public function update_footer_menu_status(Request $request)
{
 if ( $request->input('id') ) 
 {
  $footerMenu = FooterMenu::find($request->input('id'));

  if($footerMenu->status == false)
  {
   $footerMenu->status  = true;
   $footerMenu->save();
   return response(['msg' => 'Menu status has been activated successfully', 'status' => 'success']); 

 }else{
   $footerMenu->status  = false;
   $footerMenu->save();
   return response(['msg' => 'Menu status has been deactivated successfully', 'status' => 'declined']); 
 }  
}

}

public function destroy_footer_menu(Request $request)
{
 if ( $request->input('id') ) 
 {
  $footerMenu = FooterMenu::find($request->input('id'));         
  $footerMenu->delete();
  return response(['msg' => 'Menu has been deleted successfully', 'status' => 'success']);
}

return response(['msg' => 'Failed deleting the menu', 'status' => 'failed']);
}

public function edit_footer_menu($slug)
{
    $footerMenu = FooterMenu::findBySlugOrFail($slug);
    return view('admin.content_management.footer_menu.edit_footer_menu', compact('footerMenu'));
}

public function update_footer_menu(Request $request, $slug)
{
 $footerMenu = FooterMenu::findBySlugOrFail($slug);

 $validatedData = $request->validate([
     'name'    => 'required|string',
     'url'     => 'required|url'
 ]);


 $footerMenu->name = $request->input('name');
 $footerMenu->url  = $request->input('url');
 $footerMenu->save();

 Session::flash('success', 'Menu was updated.');
 return redirect()->route('admin.footermenus');                            
}

}