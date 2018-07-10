<?php

namespace App\Providers;

use App\Http\ViewComposer\Sidebar;
use Illuminate\Support\ServiceProvider;

class FrontEndCategoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer("include.public.filter",Sidebar::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
