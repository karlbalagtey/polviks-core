<?php

use App\Models\Agent;
use App\Models\Customer;
use Faker\Generator as Faker;
use App\Models\ServiceTransaction;

$factory->define(ServiceTransaction::class, function (Faker $faker) {
	$agent = Agent::has('services')->get()->random();
	$customer = Customer::all()->random();

    return [
        'quantity' => $faker->numberBetween(1,3),
        'customer_id' => $customer->id,
        'service_id' => $agent->services->random()->id,
    ];
});
