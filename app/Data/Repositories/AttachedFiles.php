<?php
namespace App\Data\Repositories;

use App\Data\Models\AttachedFile as AttachedFileModel;

class AttachedFiles extends Repository
{
    protected $model = AttachedFileModel::class;
}
