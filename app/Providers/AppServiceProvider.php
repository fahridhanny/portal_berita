<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        $this->publishes(
            [
                __DIR__ . '/../../config' => config_path('lfm.php'),
                //__DIR__ . '/../../public' => public_path('vendor/laravel-filemanager'),
                __DIR__.'/../Handlers/LfmConfigHandler.php' => base_path('app/Handlers/LfmConfigHandler.php')
            ]
        );
        $this->publishes([
            __DIR__ . '/../../public' => public_path('vendor/laravel-filemanager'),
        ]);

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'laravel-filemanager');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-filemanager');
    }
}
