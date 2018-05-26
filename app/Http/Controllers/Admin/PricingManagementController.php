<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Pricing;

class PricingManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function show_page()
    {
    	$prices_yauzers = Pricing::where('type', 'price')->first();
    	return view('admin.pricing_management.show_page',compact('prices_yauzers'));
    }

    public function store_plans(Request $request)
    {
        $prices_yauzers = Pricing::where('type', 'price')->first();
        $prices_yauzers->update($request->all());
        return redirect()->back()->with("success","Information has been updated successfully.");
    }
}
