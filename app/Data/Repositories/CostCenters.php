<?php

namespace App\Data\Repositories;

use App\Support\Constants;
use App\Data\Models\CostCenter;

class CostCenters extends Repository
{
    /**
     * @var string
     */
    protected $model = CostCenter::class;

    public function withoutControlTypes()
    {
        $this->addCustomQuery(function ($query) {
            $query->whereNotIn('code', [
                Constants::COST_CENTER_CREDIT_ID,
                Constants::COST_CENTER_TRANSPORT_CREDIT_ID,
                Constants::COST_CENTER_TRANSPORT_DEBIT_ID,
            ]);
        });

        return $this;
    }

    public function transform($data)
    {
        $this->addTransformationPlugin(function ($costCenter) {
            $costCenter[
                'name'
            ] = "{$costCenter['code']} - {$costCenter['name']}";

            return $costCenter;
        });

        return parent::transform($data);
    }
}
