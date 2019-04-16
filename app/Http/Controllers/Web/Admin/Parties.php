<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Party as PartyRequest;
use App\Data\Repositories\Parties as PartiesRepository;

class Parties extends Controller
{
    private $repository;

    public function __construct(PartiesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(PartiesRepository $repository, Request $request)
    {
        return view('admin.parties.index')
            ->with('search', $request->get('search'))
            ->with('parties', $repository->all());
    }

    public function show($id)
    {
        return view('admin.parties.form')
            ->with('formDisabled', true)
            ->with(['party' => $this->repository->findById($id)]);
    }

    public function store(PartyRequest $request)
    {
        $this->repository->createFromRequest($request);

        return redirect()
            ->route('parties.index')
            ->with($this->getSuccessMessage('Partido Gravado com Sucesso'));
    }

    public function create()
    {
        return view('admin.parties.form')->with([
            'party' => app(PartiesRepository::class)->new(),
        ]);
    }
}
