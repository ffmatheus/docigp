<?php

namespace App\Data\Models;

use App\Data\Traits\ModelActionable;

class EntryType extends Model
{
    use ModelActionable;

    protected $fillable = ['name', 'document_number_required'];

    protected $orderBy = ['name' => 'asc'];
}
