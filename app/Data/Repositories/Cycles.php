<?php

namespace App\Data\Repositories;

use App\Data\Models\Cycle;
use Illuminate\Support\Facades\Hash;

class Cycles extends Repository
{
    /**
     * @var string
     */
    protected $model = Cycle::class;
}
