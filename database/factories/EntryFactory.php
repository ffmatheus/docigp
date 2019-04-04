<?php

use Faker\Generator as Faker;
use App\Data\Models\Entry as EntryModel;
use App\Data\Repositories\CongressmanBudgets;
use App\Data\Repositories\Users as UsersRepository;

$factory->define(EntryModel::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTimeBetween(
            $startDate = \Carbon\Carbon::now()->startOfMonth(),
            $endDate = \Carbon\Carbon::now()->endOfMonth(),
            $timezone = null
        ),
        'value' => $faker->randomFloat(2, 0.1, 1000),
        'object' => $faker->text(30),
        'to' => $faker->name,
        'congressman_budget_id' => app(
            CongressmanBudgets::class
        )->randomElement()->id,
        'verified_at' => ($verified = rand(0, 1) ? $faker->date : null),
        'authorised_at' => ($authorised =
            $verified && rand(0, 1) ? $faker->date : null),
        'published_at' => ($published =
            $authorised && rand(0, 1) ? $faker->date : null),
        'verified_by_id' => $verified
            ? app(UsersRepository::class)->randomElement()->id
            : null,
        'authorised_by_id' => $authorised
            ? app(UsersRepository::class)->randomElement()->id
            : null,
        'published_by_id' => $published
            ? app(UsersRepository::class)->randomElement()->id
            : null,
        'created_by_id' => app(UsersRepository::class)->randomElement()->id,
        'updated_by_id' => app(UsersRepository::class)->randomElement()->id,
    ];
});
