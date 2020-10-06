<?php

namespace Cultro;

use Illuminate\Support\ServiceProvider;

class CultroServiceProvider extends ServiceProvider
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
        $this->publishes([
            __DIR__.'/../config/cultro.php' => config_path('cultro.php'),
            __DIR__.'/../config/cultro_scheme.php' => config_path('cultro_scheme.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__.'/../config/cultro.php', 'cultro'
        );

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        
        

    }
}
