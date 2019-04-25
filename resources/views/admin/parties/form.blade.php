@extends('layouts.app')

@section('content')
    <div class="card card-default" id="vue-parties">
        <form name="formulario" id="formulario" @if($mode == 'edit') action="{{ route('parties.update', ['id' => $party->id]) }}" @else action="{{ route('parties.store')}}" @endIf method="POST">
            {{ csrf_field() }}
            <input name="id" type="hidden" value="{{ $party->id }}" id="id" >

            <div class="card-header">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h4 class="mb-0">
                            <a href="{{ route('parties.index') }}">Partidos</a>

                            @if (is_null($party->id))
                                > NOVO
                            @else
                                > {{ $party->code }}
                            @endif
                        </h4>
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end">
                        @include('partials.edit-button', ['model'=>$party])
                        @include('partials.save-button', ['model'=>$party])
                    </div>
                </div>
            </div>

            <div class="card-body">
                @include('partials.alerts')
                @if ($errors->has('code'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                @if ($errors->has('name'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('name') }}
                    </div>
                @endif

                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="code">Sigla</label>
                        <input name="code" value="{{is_null(old('code')) ? $party->code : old('code')}}" class="form-control" id="code" aria-describedby="nameHelp" placeholder="Sigla" @include('partials.disabled', ['model'=>$party])>
                    </div>

                    <div class="form-group col-md-10">
                        <label for="name">Nome</label>
                        <input name="name" value="{{is_null(old('name')) ? $party->name : old('name')}}" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Nome" @include('partials.disabled', ['model'=>$party])>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
