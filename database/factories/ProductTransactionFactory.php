<?php

use App\Models\Agent;
use App\Models\Customer;
use Faker\Generator as Faker;
use App\Models\ProductTransaction;

$factory->define(ProductTransaction::class, function (Faker $faker) {
	$agent = Agent::has('products')->get()->random();
	$customer = Customer::all()->random();

    return [
        'quantity' => $faker->numberBetween(1,3),
        'customer_id' => $customer->id,
        'product_id' => $agent->products->random()->id,
    ];
});
