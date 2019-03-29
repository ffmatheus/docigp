<?php

namespace App\Data\Repositories;

use App\Data\Models\Budget;
use Illuminate\Support\Facades\Hash;

class Budgets extends Repository
{
    /**
     * @var string
     */
    protected $model = Budget::class;
}
