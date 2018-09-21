<?php

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

$factory->define(App\Subscription::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'token' => str_random(64),
        'expired_at' => $faker->dateTimeBetween('-1 year', '+1 year'),
        'is_active' => $faker->boolean()
    ];
});

$factory->afterCreating(App\Subscription::class, function ($subscription, $faker) {
    $subscription->files()->save(factory(App\File::class)->make());
});
