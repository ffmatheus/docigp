<?php

namespace App\Data\Repositories;

use App\Data\Models\EntryDocument;
use Illuminate\Support\Facades\Hash;

class EntryDocuments extends Repository
{
    /**
     * @var string
     */
    protected $model = EntryDocument::class;
}
