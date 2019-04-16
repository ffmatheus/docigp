<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\legislature as LegislatureRequest;
use App\Data\Repositories\Legislatures as LegislaturesRepository;
use App\Data\Repositories\CongressmanLegislatures as CongressmanLegislaturesRepository;

class Legislatures extends Controller
{
    public function index()
    {
        return view('admin.legislatures.index')->with(
            'legislatures',
            app(LegislaturesRepository::class)
                ->model()
                ->all()
        );
    }

    public function create()
    {
        return view('admin.legislatures.form')->with([
            'legislature' => app(LegislaturesRepository::class)->new(),
        ]);
    }

    public function store(LegislatureRequest $request)
    {
        $request->merge(['created_by_id' => current_user()->id]);
        app(LegislaturesRepository::class)->create($request->all());
        return redirect()->route('legislatures.index');
    }

    public function show($id)
    {
        return view('admin.legislatures.form')
            ->with('formDisabled', true)
            ->with([
                'legislature' => app(LegislaturesRepository::class)->findById(
                    $id
                ),
            ])
            ->with([
                'congressmanLegislatures' => app(
                    CongressmanLegislaturesRepository::class
                )->filterByLegislatureId($id),
            ]);
    }
}
