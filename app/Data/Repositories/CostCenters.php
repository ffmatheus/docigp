<?php

namespace App\Data\Repositories;

use App\Data\Models\CostCenter;

class CostCenters extends Repository
{
    /**
     * @var string
     */
    protected $model = CostCenter::class;

    /**
     * @return mixed
     */
    public function all()
    {
        $this->shouldPaginate = false;

        return parent::all();
    }

    public function transform($data)
    {
        $this->addTransformationPlugin(function ($costCenter) {
            $costCenter['name'] =
                $costCenter['code'] . ' - ' . $costCenter['name'];

            return $costCenter;
        });

        return parent::transform($data);
    }
}
