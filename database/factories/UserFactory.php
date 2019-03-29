<?php

use App\Data\Models\User as UserModel;
use Illuminate\Support\Str;
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

$factory->define(UserModel::class, function (Faker $faker) {
    preg_match('/(.*?)@(.*)/', $faker->unique()->safeEmail, $output_array);

    return [
        'name' => $faker->name,
        'username' => $output_array[1],
        'email' => $output_array[0],
        'email_verified_at' => now(),
        'password' =>
            '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
