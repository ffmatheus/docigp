@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <div class="row">
                <div class="col-xs-8 col-md-10">
                    <h4 class="mb-0">
                        <a href="{{ route('upload-files.index') }}">Arquivos</a>

{{--                        @if(is_null($uploadedFiles->id))--}}
{{--                            > NOVA--}}
{{--                        @else--}}
{{--                            > {{ $uploadedFiles->id }}--}}
{{--                        @endif--}}
                    </h4>
                </div>

                <div class="col-xs-4 col-md-2 text-right">
                    @include('partials.save-button')
                </div>
            </div>
        </div>

        <div class="card-body">
            @include('partials.alerts')

            @if ($errors->has('file'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('file') }}
                </div>
            @endif

            <form name="uploadFiles" id="uploadFiles" method="post" action="{{ route('uploadFiles.store') }}"  enctype="multipart/form-data">
                {{ csrf_field() }}

                <p>
                    <label>Aquivo: </label>
                    <input type="text" name="name" id="name" >
                </p>
                <p>
                    <label>Arquivo: </label>
                    <input type="file" name="file" id="file"  />
                </p>

                @include('partials.save-button')
            </form>
        </div>
    </div>
@endsection
