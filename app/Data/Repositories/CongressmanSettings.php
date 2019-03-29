<?php

namespace App\Data\Repositories;

use App\Data\Models\CongressmanSetting;
use Illuminate\Support\Facades\Hash;

class CongressmanSettings extends Repository
{
    /**
     * @var string
     */
    protected $model = CongressmanSetting::class;
}
