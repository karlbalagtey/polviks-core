<?php

namespace App\Providers;

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
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $models = array(
            'Customer',
            'User',
            'Agent',
            'Product',
            'Service',
            'Category',
            'ServiceTransaction'
        );

        foreach ($models as $model) {
            $this->app->bind("App\Contracts\\{$model}Repository", "App\Repositories\\{$model}EloquentRepository");
        }
    }
}
