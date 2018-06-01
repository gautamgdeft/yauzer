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
use App\Faq;
use App\SiteCms;
use Image;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use File;

class ContentManagementController extends Controller
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

        $filterPages = Page::where ( 'name', 'LIKE', '%' . $search_parameter . '%' )->orWhere ( 'pageurl', 'LIKE', '%' . $search_parameter . '%' )->paginate (10)->setPath ( '' );
        $pagination = $filterPages->appends ( array (
              'search_parameter' => $request->search_parameter 
          ) );
          
        if (count ( $filterPages ) > 0)
        return view ( 'admin.content_management.pages.page_listing' )->withDetails ( $filterPages )->withQuery ( $search_parameter );
       }

        return view ( 'admin.content_management.pages.page_listing' )->withMessage ( 'No Details found. Try to search again !' );
 } 

 public function pages()
 {
  $pages = Page::orderBy('id', 'desc')->paginate(10);		
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
 Session::flash('success', 'Page has been updated.');
 return redirect()->route('admin.pages');                          	
}

public function view_page($slug)
{
       $page = Page::findBySlugOrFail($slug);
       return view('admin.content_management.pages.view_page', ['page' => $page]);  
}

public function images()
{
    	#return view('admin.content_management.sliderimages.images');
}


public function sliderimages()
{
 $sliderImages = SliderImage::orderBy('id', 'desc')->paginate(10);
 return view('admin.content_management.sliderimages.sliderimages',['sliderImages' => $sliderImages]);
}


public function new_slider_image()
{
 return view('admin.content_management.sliderimages.new_slider_image');

}


public function store_slider_image(Request $request)
{

  $validatedData = $request->validate([
    'image_alt_text'    => 'required|string',
    'h2_description'    => 'required|string',
    'h3_description'    => 'required|string',
    'avatar'            => 'image:jpg,png,jpeg,gif|unique:sliderimages'
  ]);

        //Storing SliderImages
  $sliderImage = SliderImage::create(
   array(
    'image_alt_text' => $request->input('image_alt_text'),                  
    'h2_description'    => $request->input('h2_description'),
    'h3_description'    => $request->input('h3_description'),                  
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
 $previousImage = $sliderImage->avatar;

 $validatedData = $request->validate([
   'image_alt_text' => 'required|string',
   'h2_description'    => 'required|string',
   'h3_description'    => 'required|string',
   'avatar'         => 'image:jpg,png,jpeg,gif|unique:sliderimages'
 ]);


 $sliderImage->image_alt_text    = $request->input('image_alt_text');
 $sliderImage->h2_description    = $request->input('h2_description');
 $sliderImage->h3_description    = $request->input('h3_description');
 $sliderImage->save();

 if($request->hasFile('avatar'))
 {   

    $slideImage = public_path("uploads/sliderAvatars/{$previousImage}"); // get previous image from folder
    if (File::exists($slideImage)) { // unlink or remove previous image from folder
        unlink($slideImage);
    }       
   $avatar = $request->file('avatar');

               //Using Helper/helpers.php
   uploadSliderAvatar($avatar, $sliderImage);

 } 

 Session::flash('success', 'Slider image has been updated.');
 return redirect()->route('admin.sliderimages');                          	
}

public function view_slider_image($slug)
{
       $sliderImage = SliderImage::findBySlugOrFail($slug);
       return view('admin.content_management.sliderimages.view_slider_image', ['sliderImage' => $sliderImage]); 
}


public function search_header_menu(Request $request)
{
       $search_parameter = $request->search_parameter;
       if($search_parameter != "")
       {

        $filterHeaderMenu = HeaderMenu::where ( 'name', 'LIKE', '%' . $search_parameter . '%' )->orWhere ( 'url', 'LIKE', '%' . $search_parameter . '%' )->paginate (10)->setPath ( '' );
        $pagination = $filterHeaderMenu->appends ( array (
              'search_parameter' => $request->search_parameter 
          ) );
          
        if (count ( $filterHeaderMenu ) > 0)
        return view ( 'admin.content_management.header_menu.listing' )->withDetails ( $filterHeaderMenu )->withQuery ( $search_parameter );
       }

        return view ( 'admin.content_management.header_menu.listing' )->withMessage ( 'No Details found. Try to search again !' );
} 


public function headermenus()
{
  $headerMenus = HeaderMenu::orderBy('id', 'desc')->paginate(10);
  return view('admin.content_management.header_menu.listing',compact('headerMenus'));  
}

public function show_header_menu_form()
{
  $pages = Page::all();
  return view('admin.content_management.header_menu.show_header_menu_form', compact('pages'));
}

public function store_header_menu(Request $request)
{
   $validatedData = $request->validate([
     'page_id' => 'required',
     'name'    => 'required|string',
     'url'     => 'required|url'
   ]);
  
  $headerMenu = new HeaderMenu;
  $headerMenu->name = $request->name;
  $headerMenu->url  = $request->url;
  $headerMenu->page_id  = $request->page_id;

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
    $pages = Page::all();
    return view('admin.content_management.header_menu.edit_header_menu', compact('headerMenu', 'pages'));
}

public function update_header_menu(Request $request, $slug)
{
 $headerMenu = HeaderMenu::findBySlugOrFail($slug);

 $validatedData = $request->validate([
     'page_id' => 'required',
     'name'    => 'required|string',
     'url'     => 'required|url'
 ]);


 $headerMenu->name = $request->input('name');
 $headerMenu->url  = $request->input('url');
 $headerMenu->page_id  = $request->input('page_id');
 $headerMenu->save();

 Session::flash('success', 'Menu has been updated.');
 return redirect()->route('admin.headermenus');                            
}

public function view_header_menu($slug)
{
       $headerMenu = HeaderMenu::findBySlugOrFail($slug);
       return view('admin.content_management.header_menu.view_header_menu', ['headerMenu' => $headerMenu]);  
}

public function search_footer_menu(Request $request)
{
       $search_parameter = $request->search_parameter;
       if($search_parameter != "")
       {

        $filterFooterMenu = FooterMenu::where ( 'name', 'LIKE', '%' . $search_parameter . '%' )->orWhere ( 'url', 'LIKE', '%' . $search_parameter . '%' )->paginate (10)->setPath ( '' );
        $pagination = $filterFooterMenu->appends ( array (
              'search_parameter' => $request->search_parameter 
          ) );
          
        if (count ( $filterFooterMenu ) > 0)
        return view ( 'admin.content_management.footer_menu.listing' )->withDetails ( $filterFooterMenu )->withQuery ( $search_parameter );
       }

        return view ( 'admin.content_management.footer_menu.listing' )->withMessage ( 'No Details found. Try to search again !' );
} 

public function get_menu_links(Request $request)
{
    $menu_url = Page::where('id', $request->id)->where('status', 1)->first();
    if(@sizeof($menu_url)){          
    return response()->json(['status' => 'success', 'menu_url' => $menu_url->pageurl, 'page_name' => $menu_url->name]);
    }else{
    return response(['msg' => 'Cannot find the menu url. Try again', 'status' => 'failed']);  
    }
}

public function footermenus()
{
  $footerMenus = FooterMenu::orderBy('id', 'desc')->paginate(10);
  return view('admin.content_management.footer_menu.listing',compact('footerMenus'));  
}

public function show_footer_menu_form()
{
  $pages = Page::all();
  return view('admin.content_management.footer_menu.show_footer_menu_form', compact('pages'));
}

public function store_footer_menu(Request $request)
{
   $validatedData = $request->validate([
     'page_id' => 'required', 
     'name'    => 'required|string',
     'url'     => 'required|url'
   ]);
  
  $footerMenu = new FooterMenu;
  $footerMenu->name = $request->name;
  $footerMenu->url  = $request->url;
  $footerMenu->page_id  = $request->page_id;

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
    $pages = Page::all();
    $footerMenu = FooterMenu::findBySlugOrFail($slug);
    return view('admin.content_management.footer_menu.edit_footer_menu', compact('footerMenu', 'pages'));
}

public function update_footer_menu(Request $request, $slug)
{
 $footerMenu = FooterMenu::findBySlugOrFail($slug);

 $validatedData = $request->validate([
     'page_id' => 'required',
     'name'    => 'required|string',
     'url'     => 'required|url'
 ]);


 $footerMenu->name = $request->input('name');
 $footerMenu->url  = $request->input('url');
 $footerMenu->page_id  = $request->input('page_id');
 $footerMenu->save();

 Session::flash('success', 'Menu has been updated.');
 return redirect()->route('admin.footermenus');                            
}

public function view_footer_menu($slug)
{
   $footerMenu = FooterMenu::findBySlugOrFail($slug);
   return view('admin.content_management.footer_menu.view_footer_menu', ['footerMenu' => $footerMenu]);  
}

public function faqs()
{
  $faqs = Faq::orderBy('id', 'desc')->paginate(10);
  return view('admin.content_management.faqs.listing', compact('faqs'));
}

public function show_faq_form()
{ 
  return view('admin.content_management.faqs.show_faq_form'); 
}

public function store_faq(Request $request)
{
  $validatedData = $request->validate([
    'question' => 'required|string',
    'answer'   => 'required'
  ]);

   $faq = new Faq;
   $faq->question = $request->question;
   $faq->answer = $request->answer;
   $faq->save();

  return redirect()->route('admin.faqs')
  ->with("success","FAQ has been added successfuly");     

}

public function update_faq_status(Request $request)
{
 if ( $request->input('id') ) 
 {
  $faq = Faq::find($request->input('id'));

  if($faq->status == false)
  {
   $faq->status  = true;
   $faq->save();
   return response(['msg' => 'FAQ status has been activated successfully', 'status' => 'success']); 

  }else{
   $faq->status  = false;
   $faq->save();
   return response(['msg' => 'FAQ status has been deactivated successfully', 'status' => 'declined']); 
  }  
 }
}

public function view_faq($slug)
{
       $faq = Faq::findBySlugOrFail($slug);
       return view('admin.content_management.faqs.view_faq', ['faq' => $faq]);  
}

public function destroy_faq(Request $request)
{
 if ( $request->input('id') ) 
 {
  $faq = Faq::find($request->input('id'));         
  $faq->delete();
  return response(['msg' => 'FAQ has been deleted successfully', 'status' => 'success']);
 }

  return response(['msg' => 'FAQ deleting the menu', 'status' => 'failed']);  
}

public function edit_faq($slug)
{
    $faq = Faq::findBySlugOrFail($slug);
    return view('admin.content_management.faqs.edit_faq_form', compact('faq'));
}

public function update_faq(Request $request, $slug)
{
 $faq = Faq::findBySlugOrFail($slug);

 $validatedData = $request->validate([
     'question'    => 'required|string',
     'answer'      => 'required'
 ]);


 $faq->question = $request->input('question');
 $faq->answer   = $request->input('answer');
 $faq->save();

 Session::flash('success', 'FAQ has been updated.');
 return redirect()->route('admin.faqs');    
}

// Site CMS Pages Function For Home Page 
public function sitecms()
{
 $homecms = SiteCms::where('slug', 'home')->first();
 $default_bg_image = SiteCms::where('slug', 'business')->first(); 
 $login_signup_img = SiteCms::where('slug', 'signup-login')->first(); 
 $result_cms = SiteCms::where('slug', 'result-page')->first(); 
 $socialShareCms = SiteCms::where('slug', 'social-share-messages')->first();
 return view('admin.content_management.site_cms.index', compact('homecms', 'default_bg_image', 'login_signup_img','result_cms', 'socialShareCms'));   
}

public function update_home_cms(Request $request)
{
   $sitecms = SiteCms::where('slug', 'home')->first();
   $sitecms->update($request->all());
   Session::flash('success', 'Home page CMS has been updated successfully.');
   return redirect()->route('admin.sitecms');  
}

public function update_business_image(Request $request)
{
           $sitecms = SiteCms::where('slug', 'business')->first();

         //Saving Business Picture Avatar
           if($request->hasFile('default_bg_image'))
            {   

              $default_bg_image = public_path("uploads/siteCMSAvatars/{$sitecms->default_bg_image}"); // get previous image from folder
              if (File::exists($default_bg_image)) { // unlink or remove previous image from folder
                  unlink($default_bg_image);
              }   

              $avatar = $request->file('default_bg_image');

              //Using Helper/helpers.php
              uploadBusinessBackgroundImg($avatar, $sitecms);
            }         

           //Saving Business Picture Cominf Soon Avatar
           if($request->hasFile('picture_coming_soon'))
            {   

              $picture_coming_soon = public_path("uploads/siteCMSAvatars/{$sitecms->picture_coming_soon}"); // get previous image from folder

              if (File::exists($picture_coming_soon)) { // unlink or remove previous image from folder
                  unlink($picture_coming_soon);
              }   

              $avatar = $request->file('picture_coming_soon');

              //Using Helper/helpers.php
              uploadBusinessComingsoon($avatar, $sitecms);
            }  

            Session::flash('success', 'Business Page CMS has been updated successfully.');
            return redirect()->route('admin.sitecms');              
}

public function update_log_images(Request $request)
{

        $sitecms = SiteCms::where('slug', 'signup-login')->first();
       
         //Saving Business Picture Avatar
           if($request->hasFile('signup_bg_image'))
            {   
              $signup_bg_image = public_path("uploads/siteCMSAvatars/{$sitecms->signup_bg_image}"); 

              // get previous image from folder
              if (File::exists($signup_bg_image)) { // unlink or remove previous image from folder
                  unlink($signup_bg_image);
              }
              $sitecmsupdation = $sitecms->update($request->all());               
              $avatar1 = $request->file('signup_bg_image');

              //Using Helper/helpers.php
              uploadSignupBackgroundImg($avatar1, $sitecms);
            } 

         //Saving Business Picture Avatar
           if($request->hasFile('login_bg_image'))
            {
              $login_bg_image = public_path("uploads/siteCMSAvatars/{$sitecms->login_bg_image}");

              if (File::exists($login_bg_image)) { // unlink or remove previous image from folder
                  unlink($login_bg_image);
              }   
              $sitecmsupdation = $sitecms->update($request->all());
              $avatar2 = $request->file('login_bg_image');
              uploadLoginBackgroundImg($avatar2, $sitecms);
            }         

          //Saving Login Header Image Avatar
           if($request->hasFile('default_bg_image'))
            {
              $default_bg_image = public_path("uploads/siteCMSAvatars/{$sitecms->default_bg_image}");

              if (File::exists($default_bg_image)) { // unlink or remove previous image from folder
                  unlink($default_bg_image);
              }   
              $sitecmsupdation = $sitecms->update($request->all());
              $avatar3 = $request->file('default_bg_image');
              uploadResultBackgroundImg($avatar3, $sitecms, 'signup-login');
            }

            Session::flash('success', 'Log In & Sign Up CMS has been updated successsfully');
            return redirect()->route('admin.sitecms');   
}

public function update_result_section(Request $request)
{
   $resultcms = SiteCms::where('slug', 'result-page')->first();

    //Saving Business Picture Avatar
     if($request->hasFile('default_bg_image'))
      {   

        $default_bg_image = public_path("uploads/siteCMSAvatars/{$resultcms->default_bg_image}"); // get previous image from folder
        if (File::exists($default_bg_image)) { // unlink or remove previous image from folder
            unlink($default_bg_image);
        }   
        
        $resultcms->update($request->all());
        $avatar = $request->file('default_bg_image');
        //Using Helper/helpers.php
        uploadResultBackgroundImg($avatar, $resultcms, 'result-page');
      }else{
        $resultcms->update($request->all());
      }    
        
          
      Session::flash('success', 'Result Page Cms has been updated successfully');
      return redirect()->route('admin.sitecms');         
}

public function ownercms()
{
  $ownerHeadercms = SiteCms::where('slug', 'owner-dashboard-header')->first();
  $ownerBasicListingcms  = SiteCms::where('slug', 'owner-dashboard-basic-listing')->first();
  $ownerPricingStructurecms  = SiteCms::where('slug', 'owner-pricing-structure')->first();
  $ownerPremiumListingcms = SiteCms::where('slug', 'owner-dashboard-premium-listing')->first();
  $ownerMarketITcms = SiteCms::where('slug', 'market-header-section')->first();
  return view('admin.content_management.owner_cms.index', compact('ownerHeadercms', 'ownerBasicListingcms','ownerPricingStructurecms', 'ownerPremiumListingcms', 'ownerMarketITcms'));
}

public function update_owner_heading_section(Request $request)
{
   $ownerHeadercms = SiteCms::where('slug', 'owner-dashboard-header')->first();

    //Saving Business Picture Avatar
     if($request->hasFile('default_bg_image'))
      {   

        $default_bg_image = public_path("uploads/siteCMSAvatars/{$ownerHeadercms->default_bg_image}"); // get previous image from folder
        if (File::exists($default_bg_image)) { // unlink or remove previous image from folder
            unlink($default_bg_image);
        }   
        
        $ownerHeadercms->update($request->all());
        $avatar = $request->file('default_bg_image');
        //Using Helper/helpers.php
        uploadResultBackgroundImg($avatar, $ownerHeadercms, 'owner-dashboard-header');
      }else{
        $ownerHeadercms->update($request->all());
      }    
        
          
      Session::flash('success', 'Owner Header Section has been updated successfully');
      return redirect()->route('admin.ownercms');    
}

public function update_owner_basic_listing(Request $request)
{
    $ownerBasicListingcms = SiteCms::where('slug', 'owner-dashboard-basic-listing')->first();
    $ownerBasicListingcms->update($request->all());
    Session::flash('success', 'Owner Basic Listing Section has been updated successfully');
    return redirect()->route('admin.ownercms');
}

public function update_pricing_structure(Request $request)
{
    $ownerPricingStructurecms = SiteCms::where('slug', 'owner-pricing-structure')->first();

    //Saving Business Picture Avatar
     if($request->hasFile('default_bg_image'))
      {   

        $default_bg_image = public_path("uploads/siteCMSAvatars/{$ownerPricingStructurecms->default_bg_image}"); // get previous image from folder
        if (File::exists($default_bg_image)) { // unlink or remove previous image from folder
            unlink($default_bg_image);
        }   
        
        $ownerPricingStructurecms->update($request->all());
        $avatar = $request->file('default_bg_image');
        //Using Helper/helpers.php
        uploadResultBackgroundImg($avatar, $ownerPricingStructurecms, 'owner-pricing-structure');
      }else{
        $ownerPricingStructurecms->update($request->all());
      }    
        
          
      Session::flash('success', 'Pricing Structure Section has been updated successfully');
      return redirect()->route('admin.ownercms');    
}

public function update_owner_premium_features(Request $request)
{
    $ownerPremiumListingcms = SiteCms::where('slug', 'owner-dashboard-premium-listing')->first();
    $ownerPremiumListingcms->update($request->all());
    Session::flash('success', 'Owner Premium Listing Section has been updated successfully');
    return redirect()->route('admin.ownercms');
}

public function update_market_section(Request $request)
{
  $ownerMarketITcms = SiteCms::where('slug', 'market-header-section')->first();
  //Saving Business Picture Avatar
   if($request->hasFile('default_bg_image'))
    {   

      $default_bg_image = public_path("uploads/siteCMSAvatars/{$ownerMarketITcms->default_bg_image}"); // get previous image from folder
      if (File::exists($default_bg_image)) { // unlink or remove previous image from folder
          unlink($default_bg_image);
      }   
      
      $ownerMarketITcms->update($request->all());
      $avatar = $request->file('default_bg_image');
      //Using Helper/helpers.php
      uploadResultBackgroundImg($avatar, $ownerMarketITcms, 'market-header-section');
    }else{
      $ownerMarketITcms->update($request->all());
    }    
      
        
    Session::flash('success', 'Market It Section has been updated successfully');
    return redirect()->route('admin.ownercms');      
}

public function update_business_share(Request $request)
{
  $socialShareCms = SiteCms::where('slug', 'social-share-messages')->first();
  $socialShareCms->update($request->all());

  Session::flash('success', 'Social Share Section has been updated successfully');
    return redirect()->route('admin.sitecms');  
}


}