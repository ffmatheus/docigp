<?php

namespace App\Http\Controllers\Web\Admin;

use App\Data\Repositories\Providers as ProvidersRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\EntryType as EntryTypeRequest;
use App\Data\Repositories\EntryTypes as EntryTypesRepository;
use App\Http\Requests\ProviderUpdate as ProviderUpdateRequest;

class EntryTypes extends Controller
{
    public function index()
    {
        return view('admin.entry_types.index')->with(
            'entryTypes',
            app(EntryTypesRepository::class)
                ->model()
                ->all()
        );
    }

    public function create()
    {
        formMode('create');

        return view('admin.entry_types.form')->with([
            'entryType' => app(EntryTypesRepository::class)->new(),
        ]);
    }

    public function store(EntryTypeRequest $request)
    {
        app(EntryTypesRepository::class)->create($request->all());

        return redirect()->route('entryTypes.index');
    }

    public function show($id)
    {
        return view('admin.entry_types.form')->with([
            'entryType' => app(EntryTypesRepository::class)->findById($id),
        ]);
    }

    /**
     * @param EntryTypeRequest $request
     * @param $id
     * @return mixed
     */
    public function update(EntryTypeRequest $request, $id)
    {
        app(EntryTypesRepository::class)->update($id, $request->all());

        return redirect()->route('entryTypes.index');
    }
}
