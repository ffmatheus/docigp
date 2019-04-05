<?php

use Faker\Generator as Faker;
use App\Data\Repositories\Entries;
use App\Data\Repositories\Users as UsersRepository;
use App\Data\Models\EntryDocument as EntryDocumentModel;

$factory->define(EntryDocumentModel::class, function (Faker $faker) {
    return [
        'entry_id' => app(Entries::class)->randomElement()->id,
        'disk_name' => 'local',
        'path' => '/documents',
        'name' => sha1($faker->name . $faker->text),
        'created_by_id' => app(UsersRepository::class)->randomElement()->id,
        'updated_by_id' => app(UsersRepository::class)->randomElement()->id,
    ];
});
