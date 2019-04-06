<?php

use App\Data\Models\Congressman;
use App\Data\Repositories\Parties;

$factory->define(Congressman::class, function () {
    return [
        'name' => faker()->name,
        'nickname' => faker()->name,
        'remote_id' => '999',
        'party_id' => app(Parties::class)->randomElement()->id,
    ];
});
