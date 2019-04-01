<?php

use App\Data\Models\CongressmanLegislature as CongressmanLegislatureModel;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Repositories\Legislatures as LegislaturesRepository;
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

$factory->define(CongressmanLegislatureModel::class, function (Faker $faker) {
    return [
        'congressman_id' => rand(1, 10),
        'legislature_id' => app(LegislaturesRepository::class)->randomElement()
            ->id,
        'started_at' => $faker->date,
        'ended_at' => $faker->date,
        'created_by_id' => app(UsersRepository::class)->randomElement()->id,
        'updated_by_id' => app(UsersRepository::class)->randomElement()->id,
    ];
});
