<?php

namespace App\Data\Repositories;

use App\Data\Models\Departament as DepartamentModel;

class Departaments extends Repository
{
    /**
     * @var string
     */
    protected $model = DepartamentModel::class;

    public function createDepartamentFromCongressman($congressman)
    {
        return $this->model::firstOrCreate([
            'name' => $congressman->name,
            'congressman_id' => $congressman->id,
            'created_by_id' => 1,
            'updated_by_id' => 1,
        ]);
    }

    public function createCIDepartament()
    {
        return $this->model::firstOrCreate([
            'name' => 'Subdiretoria-Geral de Controle Interno',
            'initials' => 'CI',
            'created_by_id' => 1,
            'updated_by_id' => 1,
        ]);
    }
}
