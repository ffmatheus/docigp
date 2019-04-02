<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Data\Repositories\Congressmen as CongressmenRepository;

class Congressmen extends Controller
{

    private $repository;

    public function __construct(CongressmenRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create()
    {
        return view('admin.congressmen.form')->with([
            'congressman' => $this->repository->new(),
        ]);
    }

    public function store(
        CongressmanRequest $request,
        CongressmenRepository $repository
    ) {
        $repository->createFromRequest($request);

        return redirect()->route('admin.congressmen.index');
    }

    public function index(CongressmenRepository $repository, Request $request)
    {
        return view('admin.congressmen.index')
            ->with('search', $request->get('search'))
            ->with('congressmen', $this->repository->search($request));
    }
}
