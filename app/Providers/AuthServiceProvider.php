<?php

namespace App\Providers;

use Route;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Agent;
use App\Models\Customer;
use App\Policies\UserPolicy;
use App\Policies\AgentPolicy;
use Laravel\Passport\Passport;
use App\Policies\CustomerPolicy;
use App\Models\ProductTransaction;
use App\Models\ServiceTransaction;
use Illuminate\Support\Facades\Gate;
use App\Policies\ProductTransactionPolicy;
use App\Policies\ServiceTransactionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Customer::class => CustomerPolicy::class,
        Agent::class => AgentPolicy::class,
        User::class => UserPolicy::class,
        ProductTransaction::class => ProductTransactionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-action', function ($user) {
            return ($user instanceOf User);
        });

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
            'read-general' => 'Read general information like categories, purchased products, services, selling products, services, categories bought from sold from, your transactions (purchases and sales',
            'user-management' => 'Admin use for managing different type of users in the system',
        ]);

        // Middleware `oauth.providers` middleware defined on $routeMiddleware above
        Route::group(['middleware' => 'oauth.providers'], function () {
            Passport::routes(function ($router) {
                return $router->forAccessTokens();
            });
        });
    }
}
