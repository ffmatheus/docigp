<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CostCenter as CostCenterRequest;
use App\Data\Repositories\CostCenters as CostCentersRepository;

class CostCenters extends Controller
{
    public function index()
    {
        return view('admin.cost_centers.index')->with(
            'costCenters',
            app(CostCentersRepository::class)
                ->model()
                ->all()
        );
    }

    public function create()
    {
        return view('admin.cost_centers.form')->with([
            'costCenter' => app(CostCentersRepository::class)->new(),
        ]);
    }

    public function store(CostCenterRequest $request)
    {
        $request->merge(['created_by_id' => current_user()->id]);
        app(CostCentersRepository::class)->create($request->all());

        return redirect()->route('providers.index');
    }

    public function show($id)
    {
        return view('admin.cost_centers.form')
            ->with('formDisabled', true)
            ->with([
                'costCenter' => app(CostCentersRepository::class)->findById(
                    $id
                ),
            ]);
    }
}
