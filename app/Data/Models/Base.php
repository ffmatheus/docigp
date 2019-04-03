<?php

namespace App\Data\Models;

use App\Data\Models\Traits\Joinable;
use App\Data\Models\Traits\Selectable;
use Illuminate\Database\Eloquent\Model;

abstract class Base extends Model
{
    use Selectable, Joinable;
    use Auditable, Selectable, Joinable, Orderable, Filterable;

    protected $dates = ['created_at', 'updated_at'];
}
