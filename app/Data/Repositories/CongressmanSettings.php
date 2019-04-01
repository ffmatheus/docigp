<?php

namespace App\Data\Repositories;

use App\Data\Models\CongressmanSettings as CongressmanSettingsModel;
use Illuminate\Support\Facades\Hash;

class CongressmanSettings extends Repository
{
    /**
     * @var string
     */
    protected $model = CongressmanSettingsModel::class;
}
