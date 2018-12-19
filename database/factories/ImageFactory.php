<?php

use App\Models\Image;
use App\Models\Product;
use App\Models\Service;
use Faker\Generator as Faker;
use bheller\ImagesGenerator\ImagesGeneratorProvider;

$factory->define(Image::class, function (Faker $faker) {
    $faker->addProvider(new ImagesGeneratorProvider($faker));

	$web_product = $faker->imageGenerator(public_path().'/img/web', 1440, 720, 'png', false, true, '#1f1f1f', '#ff2222');
	$mobile_product = $faker->imageGenerator(public_path().'/img/mobile', 320, 320, 'png', false, true, '#1f1f1f', '#ff2222');
	$thumb_product = $faker->imageGenerator(public_path().'/img/thumbnail', 50, 50, 'png', false, true, '#1f1f1f', '#ff2222');

    return [
        'path' => Config::get('app.url').'/img/'.$faker->imageGenerator(public_path().'/img', 640, 480, 'png', false, true, '#1f1f1f', '#ff2222'),
        'mobile_url'  => Config::get('app.url').'/img/mobile/'.$mobile_product,
        'web_url'  => Config::get('app.url').'/img/web/'.$web_product,
        'thumbnail_url' => Config::get('app.url').'/img/thumbnail/'.$thumb_product,
        'product_id' => Product::all()->random()->id,
    ];
});