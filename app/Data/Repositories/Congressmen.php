<?php

namespace App\Data\Repositories;

use App\Data\Models\Congressman;
use Illuminate\Support\Collection;

class Congressmen extends Repository
{
    /**
     * @var string
     */
    protected $model = Congressman::class;

    /**
     * @param $party
     * @return string
     */
    protected function firstOrCreateParty($party)
    {
        return app(Parties::class)->firstOrCreate([
            'code' => $party,
            'name' => $party,
        ]);
    }

    /**
     * @param $name
     * @return string|null
     */
    protected function normalizeName(string $name)
    {
        return filled($name = trim($name)) ? $name : null;
    }

    /**
     * @param $data
     */
    public function sync(Collection $data)
    {
        $data->each(function ($congressman) {
            $this->firstOrCreate(
                [
                    'remote_id' => $congressman['ID'],
                ],
                [
                    'name' => ($name = $this->normalizeName(
                        $congressman['Nome']
                    )),

                    'nickname' =>
                        $this->normalizeName($congressman['NomePolitico']) ??
                        $name,

                    'party_id' => $this->firstOrCreateParty(
                        $congressman['SiglaPartido']
                    )->id,

                    'photo_url' => $congressman['Foto'],

                    'thumbnail_url' => $congressman['FotoPequena'],
                ]
            );
        });
    }
}
