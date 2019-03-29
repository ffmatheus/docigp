<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    protected $dates = ['created_at', 'updated_at'];
}
