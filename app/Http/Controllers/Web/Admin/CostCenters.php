<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CostCenterStore as CostCenterRequest;
use App\Data\Repositories\CostCenters as CostCentersRepository;
use App\Http\Requests\CostCenterUpdate as CostCenterUpdateRequest;

class CostCenters extends Controller
{
    public function index()
    {
        return view('admin.cost_centers.index')->with(
            'costCenters',
            app(CostCentersRepository::class)->allWithoutPagination()
        );
    }

    public function create()
    {
        formMode('create');

        return view('admin.cost_centers.form')->with([
            'costCenter' => app(CostCentersRepository::class)->new(),
        ]);
    }

    public function store(CostCenterRequest $request)
    {
        app(CostCentersRepository::class)->create($request->all());

        return redirect()->route('costCenters.index');
    }

    public function show($id)
    {
        return view('admin.cost_centers.form')->with([
            'costCenter' => app(CostCentersRepository::class)->findById($id),
        ]);
    }

    /**
     * @param CostCenterUpdateRequest $request
     * @param $id
     * @return mixed
     */
    public function update(CostCenterUpdateRequest $request, $id)
    {
        app(CostCentersRepository::class)->update($id, $request->all());

        return redirect()->route('costCenters.index');
    }
}
