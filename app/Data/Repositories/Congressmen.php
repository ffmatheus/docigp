<?php

namespace App\Data\Repositories;

use App\Data\Models\Congressman;
use App\Data\Models\CongressmanLegislature;
use PragmaRX\Coollection\Package\Coollection;

class Congressmen extends Repository
{
    /**
     * @var string
     */
    protected $model = Congressman::class;

    private function createCongressmanFromRemote($congressman)
    {
        return $this->firstOrCreate(
            [
                'remote_id' => $congressman['ID'],
            ],
            [
                'name' => ($name = $this->normalizeName($congressman['Nome'])),

                'nickname' =>
                    $this->normalizeName($congressman['NomePolitico']) ?? $name,

                'party_id' => $this->findParty($congressman['SiglaPartido'])
                    ->id,

                'photo_url' => $congressman['Foto'],

                'thumbnail_url' => $congressman['FotoPequena'],
            ]
        );
    }

    private function findParty($party)
    {
        return app(Parties::class)->findByCode(
            $this->normalizePartyCode($party)
        );
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
     * @param $party
     * @return string
     */
    private function normalizePartyCode($party)
    {
        switch ($party) {
            case 'Novo':
                return 'NOVO';
            case 'PC do B':
                return 'PCdoB';
            case 'Patriota':
                return 'PATRI';
            case 'Avante':
                return 'AVANTE';
        }

        return $party;
    }

    /**
     * @param $data
     */
    public function sync(Coollection $data)
    {
        $data->each(function ($congressman) {
            $congressman = $this->createCongressmanFromRemote($congressman);

            if ($congressman->wasRecentlyCreated) {
                $legislature = CongressmanLegislature::firstOrCreate(
                    [
                        'congressman_id' => $congressman->id,
                        'legislature_id' => app(
                            Legislatures::class
                        )->getCurrent()->id,
                    ],
                    ['started_at' => now()]
                );

                $congressman->legislatures()->save($legislature);
            }
        });
    }

    public function searchFromRequest($search = null)
    {
        $search = is_null($search)
            ? collect()
            : collect(explode(' ', $search))->map(function ($item) {
                return strtolower($item);
            });

        $columns = collect(['number' => 'string']);

        $query = $this->model::query();

        $search->each(function ($item) use ($columns, $query) {
            $columns->each(function ($type, $column) use ($query, $item) {
                if ($type === 'string') {
                    $query->orWhere(
                        DB::raw("lower({$column})"),
                        'like',
                        '%' . $item . '%'
                    );
                } else {
                    if ($this->isDate($item)) {
                        $query->orWhere($column, '=', $item);
                    }
                }
            });
        });

        return $this->makeResultForSelect($query->orderBy('name')->get());
    }

    public function transform($data)
    {


        $this->addTransformationPlugin(function ($congressman) {


            if($congressman['thumbnail_url'] !="") {
                $congressman['thumbnail_url'] = 'http://' . trim($congressman['thumbnail_url']);
            }

            if($congressman['photo_url'] !="") {
                $congressman['photo_url'] = 'http://' . trim($congressman['photo_url']);
            }

            return $congressman;
        });

        return parent::transform($data);

    }
//
//    public function all()
//    {
//        return dd($this->transform($this->model::paginate()->items()));
//    }
}
