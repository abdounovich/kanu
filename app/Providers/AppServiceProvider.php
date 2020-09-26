<?php

namespace App\Providers;

use App\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setlocale(LC_TIME, "fr_FR");
            foreach (Setting::all() as $setting) {
                Config::set('settings.'.$setting->nom, $setting->valeur);
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
