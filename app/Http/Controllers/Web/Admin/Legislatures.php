<?php

namespace App\Http\Controllers\Web\Admin;

use App\Data\Repositories\Legislatures as LegislaturesRepository;
use Illuminate\Http\Request;
use App\Http\Requests\legislature as LegislatureRequest;
use App\Http\Controllers\Controller;


class Legislatures extends Controller
{
    private $repository;

    public function __construct(LegislaturesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create()
    {
        return view('admin.legislatures.form')->with([
            'legislature' => $this->repository->new(),
        ]);
    }

    public function store(
        LegislatureRequest $request,
        LegislaturesRepository $repository
    ) {
        $repository->createFromRequest($request);

        return redirect()->route('admin.legislatures.index');
    }

    public function index(LegislaturesRepository $repository, Request $request)
    {
        return view('admin.legislatures.index')
            ->with('search', $request->get('search'))
            ->with('legislatures', $repository->search($request));
    }

    public function show($id)
    {
        return view('admin.legislatures.form')
            ->with('formDisabled', true)
            ->with(['legislatures' => $this->repository->findById($id)]);
    }
}
