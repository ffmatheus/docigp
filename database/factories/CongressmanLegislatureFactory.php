<?php

use App\Data\Models\Congressman;
use App\Data\Repositories\Legislatures;
use App\Data\Models\CongressmanLegislature;

$factory->define(CongressmanLegislature::class, function () {
    return [
        'congressman_id' => factory(Congressman::class)->create()->id,
        'legislature_id' => app(Legislatures::class)->randomElement()->id,
        'started_at' => now(),
        'ended_at' => now(),
    ];
});
