<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Data\Repositories\Congressmen as CongressmenRepository;
use App\Data\Repositories\CongressmanLegislatures as CongressmanLegislaturesRepository;

class CongressmanLegislatures extends Controller
{
    /**
     * @var CongressmenRepository
     */
    private $congressmanLegislaturesRepository;

    /**
     * Users constructor.
     *
     * @param CongressmenRepository $congressmenRepository
     */
    public function __construct(
        CongressmanLegislaturesRepository $congressmanLegislaturesRepository
    ) {
        $this->congressmanLegislaturesRepository = $congressmanLegislaturesRepository;
    }

    public function removeFromLegislature(Request $request)
    {
        $this->congressmanLegislaturesRepository->remmoveFromLegislature(
            $request['congressman_id'],
            $request['ended_at']
        );

        return redirect()
            ->route('congressmen.index')
            ->with(
                $this->getSuccessMessage('Removido da Legislatura com Sucesso')
            );
    }

    public function includeInLegislature(Request $request)
    {
        $this->congressmanLegislaturesRepository->includeInLegislature(
            $request['congressman_id'],
            $request['started_at']
        );

        return redirect()
            ->route('congressmen.index')
            ->with(
                $this->getSuccessMessage('Removido da Legislatura com Sucesso')
            );
    }
}
