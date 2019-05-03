<?php

use Carbon\Carbon;
use App\Data\Models\Congressman;
use App\Data\Repositories\Legislatures;
use App\Data\Models\CongressmanLegislature;

$factory->define(CongressmanLegislature::class, function () {
    return [
        'congressman_id' => factory(Congressman::class)->create()->id,
        'legislature_id' => app(Legislatures::class)->randomElement()->id,
        'started_at' => Carbon::parse('2019-02-01'),
    ];
});
