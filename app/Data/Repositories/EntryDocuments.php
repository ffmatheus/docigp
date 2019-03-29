<?php

namespace App\Data\Repositories;

use App\Data\Models\EntryDocument as EntryDocumentModel;

class EntryDocuments extends Repository
{
    /**
     * @var string
     */
    protected $model = EntryDocumentModel::class;

}
