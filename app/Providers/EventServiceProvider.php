<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\Event;
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
