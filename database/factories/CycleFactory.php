<?php

use App\Data\Models\Cycle as CycleModel;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\Cycles as CyclesRepository;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Data\Repositories\CongressmanLegislatures as CongressmanLegislaturesRepository;

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

$factory->define(CycleModel::class, function (Faker $faker) {
    return [
        'congressman_legislature_id' => app(
            CongressmanLegislaturesRepository::class
        )->randomElement()->id,
        'year' => rand(2015, 2030),
        'month' => rand(1, 12),
        'published_at' => $faker->date,
        'published_by_id' => app(UsersRepository::class)->randomElement()->id,
        'created_by_id' => app(UsersRepository::class)->randomElement()->id,
        'updated_by_id' => app(UsersRepository::class)->randomElement()->id,
    ];
});
