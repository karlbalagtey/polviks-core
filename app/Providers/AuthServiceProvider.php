<?php

namespace App\Providers;

use Carbon\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addMinutes(30));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
        Passport::enableImplicitGrant();

        Passport::tokensCan([
            'purchase-product' => 'Create a new transaction for a specific product',
            'manage-products' => 'Create, read, update and delete products',
            'purchase-service' => 'Create a new transaction for a specific service',
            'manage-services' => 'Create, read, update, and delete services',
            'manage-account' => 'Read your account data, id, name, email if verified. Admin does not have access to password. Modify your account data (email and password).',
            'read-general' => 'Read general information like categories, purchased products, services, selling products, categories bought from, your transactions (purchases and sales',
            'user-management' => 'Admin use for managing different type of users in the system',
        ]);
    }
}
