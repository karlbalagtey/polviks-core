<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Agent;
use App\Models\Product;
use App\Models\Service;
use App\Models\Customer;
use App\Mail\User\UserCreated;
use App\Mail\Agent\AgentCreated;
use App\Mail\User\UserEmailUpdated;
use Illuminate\Support\Facades\Mail;
use App\Mail\Agent\AgentEmailUpdated;
use Illuminate\Support\Facades\Event;
use App\Mail\Customer\CustomerCreated;
use App\Mail\Customer\CustomerEmailUpdated;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\ProductUpdated' => [
            'App\Listeners\UpdateProductQuantity',
            'App\Listeners\CheckProductAvailability'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Customer::created(function($customer) {
            retry(5, function() use ($customer) {
                Mail::to($customer)->send(new CustomerCreated($customer));
            }, 100);
        });

        Customer::updated(function($customer) {
            if ($customer->isDirty('email')) {
                retry(5, function() use ($customer) {
                    Mail::to($customer)->send(new CustomerEmailUpdated($customer));
                }, 100);
            }
        });

        Agent::created(function($agent) {
            retry(5, function() use ($agent) {
                Mail::to($agent)->send(new AgentCreated($agent));
            }, 100);
        });

        Agent::updated(function($agent) {
            if ($agent->isDirty('email')) {
                retry(5, function() use ($agent) {
                    Mail::to($agent)->send(new AgentEmailUpdated($agent));                
                }, 100);
            }
        });

        User::created(function($user) {
            retry(5, function() use ($user) {
                Mail::to($user)->send(new UserCreated($user));
            }, 100);
        });

        User::updated(function($user) {
            if ($user->isDirty('email')) {
                retry(5, function() use ($user) {
                    Mail::to($user)->send(new UserEmailUpdated($user));                
                }, 100);
            }
        });

        Product::updated(function($product) {
            if ($product->quantity == 0 && $product->isAvailable()) {
                $product->status = Product::UNAVAILABLE_PRODUCT;

                $product->save();
            }
        });

        Service::updated(function($service) {
            if ($service->quantity == 0 && $service->isAvailable()) {
                $service->status = Service::UNAVAILABLE_SERVICE;

                $service->save();
            }
        });

    }
}
