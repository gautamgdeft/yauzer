<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\ContactUS;

class CmsController extends Controller
{
    public function render_cms($slug)
    {
        switch($slug)
        {
            case 'what-is-yauzer' :
              $page = Page::findBySlugOrFail($slug);
            return view('cms.cms', compact('page'));
              break;

            case 'terms-of-service' :
              $page = Page::findBySlugOrFail($slug);
	          return view('cms.cms', compact('page'));
              break;    

            case 'privacy-policy' :
              $page = Page::findBySlugOrFail($slug);
	          return view('cms.cms', compact('page'));
              break;            

            case 'blog' :
              return redirect()->route('showBlogs');
              break;            

            case 'find-a-business' :
              dd('Find a business');
              break;
        }

    }

    public function contactus(Request $request)
    {
      if ($request->method() == 'POST')
      {
         $contact = new ContactUS($request->all());
         $contact->save();
         return redirect()->back()->with("success","Thanks for contacting us with your comments and questions. We'll respond to you very soon.");

      }else{
      return view('cms.contactus');
      }
    }

}
