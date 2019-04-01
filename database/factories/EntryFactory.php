<?php

use Faker\Generator as Faker;
use App\Data\Models\Entry as EntryModel;
use App\Data\Repositories\CongressmanBudgets;
use App\Data\Repositories\Users as UsersRepository;

$factory->define(EntryModel::class, function (Faker $faker) {
    return [
        'date' => $faker->date,
        'value' => $faker->randomFloat(2, 0.1, 1000),
        'object' => $faker->name,
        'to' => $faker->name,
        'congressman_budget_id' => app(
            CongressmanBudgets::class
        )->randomElement()->id,
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
