<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SliderImage;

class WelcomeController extends Controller
{
    public function index()
    {
    	$sliderImages = SliderImage::orderBy('id', 'desc')->get();
    	return view('home.welcome', compact('sliderImages'));
    }
}
