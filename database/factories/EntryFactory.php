<?php

use App\Data\Models\Entry as EntryModel;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\Cycles as CyclesRepository;
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

$factory->define(EntryModel::class, function (Faker $faker) {
    return [
        'date' => $faker->date,
        'value' => $faker->randomFloat(2, 0.1, 1000),
        'object' => $faker->name,
        'to' => $faker->name,
        'cycle_id' => app(CyclesRepository::class)->randomElement()->id,
        'verified_at' => $faker->date,
        'authorised_at' => $faker->date,
        'published_at' => $faker->date,
        'verified_by_id' => app(UsersRepository::class)->randomElement()->id,
        'authorised_by_id' => app(UsersRepository::class)->randomElement()->id,
        'published_by_id' => app(UsersRepository::class)->randomElement()->id,
        'created_by_id' => app(UsersRepository::class)->randomElement()->id,
        'updated_by_id' => app(UsersRepository::class)->randomElement()->id,
    ];
});
