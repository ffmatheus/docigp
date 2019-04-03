<?php

namespace App\Data\Models;

use OwenIt\Auditing\Auditable;
use App\Data\Models\Traits\Joinable;
use App\Data\Models\Traits\Orderable;
use App\Data\Models\Traits\Selectable;
use App\Data\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

abstract class Model extends Eloquent implements AuditableContract
{
    use Auditable, Selectable, Joinable, Orderable, Filterable;

    protected $dates = ['created_at', 'updated_at'];
}
