<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderStore as ProviderStoreRequest;
use App\Http\Requests\ProviderUpdate as ProviderUpdateRequest;
use App\Data\Repositories\Providers as ProvidersRepository;
use App\Support\Constants;

class Providers extends Controller
{
    public function index()
    {
        return view('admin.providers.index')->with(
            'providers',
            app(ProvidersRepository::class)
                ->disablePagination()
                ->all()
        );
    }

    public function create()
    {
        formMode(Constants::FORM_MODE_CREATE);

        return view('admin.providers.form')->with([
            'provider' => app(ProvidersRepository::class)->new(),
        ]);
    }

    public function store(ProviderStoreRequest $request)
    {
        app(ProvidersRepository::class)->create($request->all());

        return redirect()->route('providers.index');
    }

    public function show($id)
    {
        return view('admin.providers.form')->with([
            'provider' => app(ProvidersRepository::class)->findById($id),
        ]);
    }

    /**
     * @param ProviderUpdateRequest $request
     * @param $id
     * @return mixed
     */
    public function update(ProviderUpdateRequest $request, $id)
    {
        app(ProvidersRepository::class)->update($id, $request->all());

        return redirect()->route('providers.index');
    }
}
