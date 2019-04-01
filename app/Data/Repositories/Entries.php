<?php

namespace App\Data\Repositories;

use App\Data\Models\Entry;

class Entries extends Repository
{
    /**
     * @var string
     */
    protected $model = Entry::class;
}
