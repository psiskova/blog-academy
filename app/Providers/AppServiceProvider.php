<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        if ($this->app->environment('production')) {
        } else {
            $this->app->register('Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider');
            //$this->app->register('Barryvdh\Debugbar\ServiceProvider');
        }
    }
}
