<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Compartir los menus con todas las vistas.
         */
        Paginator::useBootstrap();

        view()->composer(["layouts.partials.dash-menus"], function ($view) {
            $view->with('menus', \App\Models\Configuraciones\Menu::menus());
        });
    }
}
