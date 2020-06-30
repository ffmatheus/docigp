<?php

namespace App\Data\Repositories;

use App\Support\Constants;
use App\Data\Models\CostCenter;
use Cache;

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
                    Constants::COST_CENTER_CONTROL_CODE_ARRAY
                );
            });
        }

        return $this;
    }

    public function getControlIdsArray()
    {
        return array_merge(Constants::COST_CENTER_CONTROL_ID_ARRAY, [
            $this->findByCode(4)->code
        ]);
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

    public function getTransportAndCreditIdsArray()
    {
        return Cache::remember(
            'getTransportAndCreditIdsArray',
            60,
            function () {
                return [
                    $this->findByCode(1)->id,
                    $this->findByCode(2)->id,
                    $this->findByCode(3)->id
                ];
            }
        );
    }
}
