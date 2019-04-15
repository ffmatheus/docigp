@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <div class="row">
                <div class="col-xs-8 col-md-10">
                    <h4 class="mb-0">
                        <a href="{{ route('entryTypes.index') }}">Tipos de Lançamentos</a>

                        @if(is_null($entryType->id))
                            > NOVA
                        @else
                            > {{ $entryType->name }}
                        @endif
                    </h4>
                </div>

                <div class="col-xs-4 col-md-2 text-right">
                    @include('partials.save-button')
                    @include('partials.edit-button', ['model' => $entryType])
                </div>
            </div>
        </div>

        <div class="card-body">
            @include('partials.alerts')

            @if ($errors->has('name'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('name') }}
                </div>
            @endif
            @if ($errors->has('document_number_required'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('document_number_required') }}
                </div>
            @endif

            <form name="formulario" id="formulario" action="{{ route('entryTypes.store') }}" method="POST">
                {{ csrf_field() }}

                <input type="hidden" name="id" value="{{$entryType->id}}" >

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="col-md-12">
                            <div class="form-group">

                                <label for="name">Nome</label>
                                <input type="text" name="name" id="name" value="{{$entryType->name}}"/>

                                <label for="document_number_required">Número do documento</label>
                                <input type="checkbox" name="document_number_required" id="document_number_required" {{ $entryType->document_number_required == 1 ? 'checked="checked"' : '' }}/>

                            </div>
                        </div>
                    </div>
                </div>

                @include('partials.save-button')
            </form>
        </div>
    </div>
@endsection
