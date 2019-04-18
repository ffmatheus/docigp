<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider as ProviderRequest;
use App\Data\Repositories\Providers as ProvidersRepository;

class Providers extends Controller
{
    public function index()
    {
        return view('admin.providers.index')->with(
            'providers',
            app(ProvidersRepository::class)
                ->model()
                ->all()
        );
    }

    public function create()
    {
        return view('admin.providers.form')->with([
            'provider' => app(ProvidersRepository::class)->new(),
        ]);
    }

    public function store(ProviderRequest $request)
    {
        $request->merge(['created_by_id' => current_user()->id]);
        app(ProvidersRepository::class)->create($request->all());

        return redirect()->route('providers.index');
    }

    public function show($id)
    {
        return view('admin.providers.form')->with([
            'provider' => app(ProvidersRepository::class)->findById($id),
        ]);
    }
}
