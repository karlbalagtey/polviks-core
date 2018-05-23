<?php

namespace App\Providers;

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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $models = array(
            'User',
            'Customer',
            'Agent'
        );

        foreach ($models as $model) {
            $this->app->bind('App\Contracts\{$model}Repository', 'App\Repositories\Eloquent{$model}Repository');
        }
    }
}
