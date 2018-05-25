<?php

use App\User;
use App\Agent;
use App\Customer;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'verified' => $verified = $faker->randomElement([User::VERIFIED_USER, User::UNVERIFIED_USER]),
        'verification_token' => $verified == User::VERIFIED_USER ? null : User::generateVerificationCode(),
        'admin' => $verified = $faker->randomElement([User::ADMIN_USER, User::REGULAR_USER]),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'verified' => $verified = $faker->randomElement([Customer::VERIFIED_USER, Customer::UNVERIFIED_USER]),
        'verification_token' => $verified == Customer::VERIFIED_USER ? null : Customer::generateVerificationCode(),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Agent::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'verified' => $verified = $faker->randomElement([Agent::VERIFIED_USER, Agent::UNVERIFIED_USER]),
        'verification_token' => $verified == Agent::VERIFIED_USER ? null : Agent::generateVerificationCode(),
        'admin' => $verified = $faker->randomElement([Agent::ADMIN_USER, Agent::REGULAR_USER]),
        'remember_token' => str_random(10),
    ];
});