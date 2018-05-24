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
        // $models = array(
        //     'User',
        //     'Customer',
        //     'Agent'
        // );

        // foreach ($models as $model) {
        //     $this->app->bind('App\Contracts\{$model}Repository', 'App\Repositories\Eloquent{$model}Repository');
        // }

        $this->app->bind('App\Contracts\CustomerRepository', 'App\Repositories\EloquentCustomerRepository');
        $this->app->bind('App\Contracts\UserRepository', 'App\Repositories\EloquentUserRepository');
        $this->app->bind('App\Contracts\AgentRepository', 'App\Repositories\EloquentAgentRepository');
    }
}
