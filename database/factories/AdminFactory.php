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

$factory->define( \App\Models\Admins::class, function (Faker $faker) {
    return [
        'email' => 'neihn88@gmail.com',
        'password' => bcrypt('admin'), // secret
        'remember_token' => str_random(10),
    ];
});
