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

    public function filterControlTypes()
    {
        if (current_user() && !current_user()->can('entries:control-update')) {
            $this->addCustomQuery(function ($query) {
                $query->whereNotIn(
                    'code',
                    Constants::COST_CENTER_CONTROL_ID_ARRAY
                );
            });
        }

        return $this;
    }

    public function filterRevoked()
    {
        $this->addCustomQuery(function ($query) {
            $query->notRevoked($query);
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
