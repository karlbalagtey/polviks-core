<?php

use App\Models\Agent;
use App\Models\Image;
use App\Models\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantity' => $faker->numberBetween(1, 10),
        'status' => $faker->randomElement([Service::AVAILABLE_SERVICE, Service::UNAVAILABLE_SERVICE]),
        'agent_id' => Agent::all()->random()->id,
    ];
});
