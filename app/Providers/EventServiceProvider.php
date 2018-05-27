<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Agent;
use App\Models\Product;
use App\Models\Service;
use App\Models\Customer;
use App\Mail\User\UserCreated;
use App\Mail\Agent\AgentCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use App\Mail\Customer\CustomerCreated;
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
            Mail::to($customer)->send(new CustomerCreated($customer));
        });

        Agent::created(function($agent) {
            Mail::to($agent)->send(new AgentCreated($agent));
        });

        User::created(function($user) {
            Mail::to($user)->send(new UserCreated($user));
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
