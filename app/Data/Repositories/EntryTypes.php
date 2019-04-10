<?php

namespace App\Data\Repositories;

use App\Data\Models\EntryType;

class EntryTypes extends Repository
{
    /**
     * @var string
     */
    protected $model = EntryType::class;

    /**
     * @return mixed
     */
    public function all()
    {
        $this->shouldPaginate = false;

        return parent::all();
    }
}
