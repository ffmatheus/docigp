<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntryType as EntryTypeRequest;
use App\Data\Repositories\EntryTypes as EntryTypesRepository;

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
        return view('admin.entry_types.form')->with([
            'entryType' => app(EntryTypesRepository::class)->new(),
        ]);
    }

    public function store(EntryTypeRequest $request)
    {
        $request->merge(['created_by_id' => current_user()->id]);
        app(EntryTypesRepository::class)->create($request->all());

        return redirect()->route('entryTypes.index');
    }

    public function show($id)
    {
        return view('admin.entry_types.form')
            ->with('formDisabled', true)
            ->with([
                'entryType' => app(EntryTypesRepository::class)->findById($id),
            ]);
    }
}
