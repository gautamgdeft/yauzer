<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SliderImage;
use App\BusinessCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class WelcomeController extends Controller
{

    public function checkuser()
    {
        if(Auth::user()->isUser())
        {
            return redirect()->route('user.yauzer_business');
        }else{
            
            return redirect()->route('owner.dashboard');
        }
    }

    public function index()
    {
    	$sliderImages = SliderImage::orderBy('id', 'desc')->get();
        $businessCategory = BusinessCategory::where('status', '1')->get();
        return view('home.welcome', compact('sliderImages','businessCategory'));
    }
}
