<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Blog;
use App\SiteSeo;
use App\SiteCms;
use App\Pricing;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); //Solved by increasing StringLength

        #Calling-Global-Function-For-Footer-Menu-Helpers.php
        $footerMenus = footer_menus();
        $headerMenus = header_menus();
        $blogs = Blog::orderBy('id', 'desc')->get();
        $premiumseoDetail = SiteSeo::where('slug', 'premium')->first();
        $basicseoDetail = SiteSeo::where('slug', 'basic')->first();
        $cityseoDetail = SiteSeo::where('slug', 'city')->first();
        $categoryseoDetail = SiteSeo::where('slug', 'category')->first();
        $homeseoDetail = SiteSeo::where('slug', 'home')->first();
        $homeCMSdata = SiteCms::where('slug', 'home')->first();
        $loginSignImage = SiteCms::where('slug', 'signup-login')->first();

        $plans = Pricing::where('type', 'price')->first();

        View::share('headerMenus', $headerMenus);
        View::share('footerMenus', $footerMenus);
        View::share('blogs', $blogs);
        View::share('premiumseoDetail', $premiumseoDetail);
        View::share('basicseoDetail', $basicseoDetail);
        View::share('cityseoDetail', $cityseoDetail);
        View::share('categoryseoDetail', $categoryseoDetail);
        View::share('homeseoDetail', $homeseoDetail);
        View::share('homeCMSdata', $homeCMSdata);
        View::share('loginSignImage', $loginSignImage);
        View::share('plans', $plans);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
