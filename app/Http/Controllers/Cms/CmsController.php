<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;

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
}
