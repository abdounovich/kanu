<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    
   
    public function boot(UrlGenerator $url)
    {
        setlocale(LC_TIME, "fr_FR");
        if (env('APP_ENV') == 'production') {
            $url->forceScheme('https');
        }
    }
        

    

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       
    }
}
