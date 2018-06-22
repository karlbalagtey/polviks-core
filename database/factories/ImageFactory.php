<?php

use App\Models\Image;
use App\Models\Product;
use App\Models\Service;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
	$web_product = $faker->imageUrl(1440, 720, 'nature');
	$mobile_product = $faker->imageUrl(320, 320, 'nature');
	$thumb_product = $faker->imageUrl(60, 60, 'nature');

    return [
        'path' => $faker->imageUrl(640, 480),
        'mobile_url'  => $mobile_product,
        'web_url'  => $web_product,
        'thumbnail_url' => $thumb_product,
        'product_id' => Product::all()->random()->id,
    ];
});