<?php

namespace App\Data\Repositories;

use App\Data\Models\CongressmanLegislature;
use Illuminate\Support\Facades\Hash;

class CongressmanLegislatures extends Repository
{
    /**
     * @var string
     */
    protected $model = CongressmanLegislature::class;
}
