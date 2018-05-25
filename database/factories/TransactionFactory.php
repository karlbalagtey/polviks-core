<?php

use App\User;
use App\Agent;
use App\Customer;
use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
	$agent = Agent::has('products')->get()->random();
	$customer = Customer::all()->random();

    return [
        'quantity' => $faker->numberBetween(1,3),
        'customer_id' => $customer->id,
        'product_id' => $agent->products->random()->id,
    ];
});
