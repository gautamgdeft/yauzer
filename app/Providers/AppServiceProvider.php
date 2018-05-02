<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Blog;

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

        View::share('headerMenus', $headerMenus);
        View::share('footerMenus', $footerMenus);
        View::share('blogs', $blogs);
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
