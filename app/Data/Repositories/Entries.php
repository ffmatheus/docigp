<?php

namespace App\Data\Repositories;

use App\Data\Models\Entry;
use Illuminate\Support\Facades\Hash;

class Entries extends Repository
{
    /**
     * @var string
     */
    protected $model = Entry::class;
}
