<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Data\Repositories\Congressmen as CongressmenRepository;

class Congressmen extends Controller
{

    private $repository;

    public function __construct(CongressmenRepository $repository)
    {
        $this->repository = $repository;
    }


    public function index()
    {
        return view('admin.congressmen.index');
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
}
