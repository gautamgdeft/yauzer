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

 $validatedData = $request->validate([
   'image_alt_text' => 'required|string',
   'h2_description'    => 'required|string',
   'h3_description'    => 'required|string',
   'avatar'         => 'image:jpg,png,jpeg,gif|unique:sliderimages'
 ]);


 $sliderImage->image_alt_text = $request->input('image_alt_text');
 $sliderImage->h2_description    = $request->input('h2_description');
 $sliderImage->h3_description    = $request->input('h3_description');
 $sliderImage->save();

 if($request->hasFile('avatar'))
 {   
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

}