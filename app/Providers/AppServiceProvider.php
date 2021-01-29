<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Document as DocumentHelper; //Классу Document дан псевдоним.

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
        $this->app->singleton('document', function() {
            return new DocumentHelper();
        });
    }
}
