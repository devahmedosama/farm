<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.content.header',function($view){
            $setting =  \App\Models\Setting::first();
            $lang =  \App::getLocale();
            $view->with('setting',$setting)
                ->with('lang',$lang);
        });
        Paginator::useBootstrap();
    }
}
