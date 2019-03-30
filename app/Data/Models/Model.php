<?php

namespace App\Data\Models;

use OwenIt\Auditing\Auditable;
use App\Data\Models\Traits\Joinable;
use App\Data\Models\Traits\Selectable;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    use Auditable, Selectable, Joinable;

    protected $dates = ['created_at', 'updated_at'];
}
