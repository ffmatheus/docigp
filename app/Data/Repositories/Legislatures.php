<?php

namespace App\Data\Repositories;

use App\Data\Models\Legislature;
use Illuminate\Support\Facades\Hash;

class Legislatures extends Repository
{
    /**
     * @var string
     */
    protected $model = Legislature::class;
}
