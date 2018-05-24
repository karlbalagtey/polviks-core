<?php

use App\User;
use App\Agent;
use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
	$seller = Agent::has('products')->get()->random();
	$buyer = User::all()->except($seller->id)->random();

    return [
        'quantity' => $factory->numberBetween(1,3),
        'buyer_id' => $buyer->id,
        'product_id' => $seller->products->random()->id,
    ];
});
