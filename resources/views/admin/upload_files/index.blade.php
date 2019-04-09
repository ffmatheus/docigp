@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="mb-0">Arquivos</h4>
                </div>

                <div class="col-md-9">
{{--                    @include(--}}
{{--                        '.layouts.partials.search-form',--}}
{{--                        [--}}
{{--                            'routeSearch' => 'upload_files.index',--}}
{{--                            'routeCreate' => 'upload_files.create',--}}
{{--                        ]--}}
{{--                    )--}}
                </div>
            </div>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @include('admin.upload_files.partials.table')
        </div>
    </div>
@endsection
