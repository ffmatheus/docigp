@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-8 col-md-10">
                    <h4>
                        <a href="{{ route('costCenters.index') }}">Centros de Custo</a>

                        @if(is_null($costCenter->id))
                            > NOVA
                        @else
                            > {{ $costCenter->cpf_cnpj }} - {{ $costCenter->name }}
                        @endif
                    </h4>
                </div>

                <div class="col-xs-4 col-md-2">
                    @include('partials.save-button')
                    @include('partials.edit-button', ['model' => $costCenter])
                </div>
            </div>
        </div>

        <div class="panel-body">
            @include('partials.alerts')

            @if ($errors->has('name'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('name') }}
                </div>
            @endif
            @if ($errors->has('code'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('code') }}
                </div>
            @endif
            @if ($errors->has('parent_code'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('parent_code') }}
                </div>
            @endif
            @if ($errors->has('frequency'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('frequency') }}
                </div>
            @endif
            @if ($errors->has('limit'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('limit') }}
                </div>
            @endif



            <form name="formulario" id="formulario" action="{{ route('costCenters.store') }}" method="POST">
                {{ csrf_field() }}

                <input type="hidden" name="id" value="{{$costCenter->id}}" >

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="col-md-12">
                            <div class="form-group">

                                <label for="name">Nome</label>
                                <input type="text" name="name" id="name" value="{{$costCenter->name}}"/>

                                <label for="code">Sigla (Código)</label>
                                <select name="code" id="code">
                                    <option value="">Selecione</option>
                                </select>

                                <label for="parent_code">Sigla Superior(Código)</label>
                                <select name="parent_code" id="parent_code">
                                    <option value="">Selecione</option>
                                </select>

                                <label for="frequency">Frequência</label>
                                <input type="text" name="frequency" id="frequency" value="{{$costCenter->frequency}}"/>

                                <label for="limit">Limite</label>
                                <input type="text" name="limit" id="limit" value="{{$costCenter->limit}}"/>

                                <label for="can_accumulate">Acumulável</label>
                                <input type="checkbox" name="can_accumulate" id="can_accumulate" value="{{$costCenter->can_accumulate}}"/>

                            </div>
                        </div>
                    </div>
                </div>

                @include('partials.save-button')
            </form>
        </div>
    </div>
@endsection
