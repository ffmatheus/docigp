<?php

namespace App\Data\Repositories;

use App\Data\Models\Party;

class Parties extends Repository
{
    /**
     * @var string
     */
    protected $model = Party::class;

    public function sync($data)
    {
        collect($data)->each(function ($party) {
            $this->firstOrCreate(
                [
                    'code' => $party['sigla'],
                ],
                [
                    'name' => $party['nome'],
                ]
            );
        });
    }
}
