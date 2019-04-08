<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\legislature as LegislatureRequest;
use App\Data\Repositories\Legislatures as LegislaturesRepository;

class Legislatures extends Controller
{
    private $repository;

    public function __construct(LegislaturesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create()
    {
        return view('admin.legislatures.show')->with([
            'legislature' => $this->repository->new(),
        ]);
    }

    public function store(LegislatureRequest $request)
    {
        $this->repository->createFromRequest($request);

        return redirect()->route('admin.legislatures.index');
    }

    public function index(Request $request)
    {
        return view('admin.legislatures.index')
            ->with('search', $request->get('search'))
            ->with('legislatures', $this->repository->search($request));
    }

    public function show($id)
    {
        return view('admin.legislatures.show')
            ->with('formDisabled', true)
            ->with(['legislature' => $this->repository->findById($id)]);
    }
}
