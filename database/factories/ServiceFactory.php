<?php

use App\Agent;
use App\Image;
use App\Service;
use Faker\Generator as Faker;

$factory->define(App\Service::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantity' => $faker->numberBetween(1, 10),
        'status' => $faker->randomElement([Service::AVAILABLE_PRODUCT, Service::UNAVAILABLE_PRODUCT]),
        'image_id' => Image::all()->random()->id,
        'agent_id' => Agent::all()->random()->id,
    ];
});
