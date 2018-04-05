<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;

class CmsController extends Controller
{
    public function what_is_yauzer()
    {
        $page = Page::findBySlugOrFail('what-is-yauzer');
    	return view('cms.what_is_yauzer', compact('page'));
    }
}
