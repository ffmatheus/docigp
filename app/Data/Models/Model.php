<?php

namespace App\Data\Models;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    use Auditable;

    protected $dates = ['created_at', 'updated_at'];
}
