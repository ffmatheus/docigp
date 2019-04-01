<?php

namespace App\Http\Controllers;

use App\Data\Repositories\Legislatures as LegislaturesRepository;
use Illuminate\Http\Request;
use App\Http\Requests\legislature as LegislatureRequest;

class Legislatures extends Controller
{
    private $repository;

    public function __construct(LegislaturesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create()
    {
        return view('legislatures.form')->with([
            'legislature' => $this->repository->new(),
        ]);
    }

    public function store(
        LegislatureRequest $request,
        LegislaturesRepository $repository
    ) {
        $repository->createFromRequest($request);

        return redirect()->route('legislatures.index');
    }

    public function index(LegislaturesRepository $repository, Request $request)
    {
        return view('legislatures.index')
            ->with('search', $request->get('search'))
            ->with('legislatures', $repository->search($request));
    }

    public function show($id)
    {
        return view('legislatures.form')
            ->with('formDisabled', true)
            ->with(['legislatures' => $this->repository->findById($id)]);
    }
}
