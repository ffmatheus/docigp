@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <div class="row">
                <div class="col-xs-8 col-md-10">
                    <h4 class="mb-0">
                        <a href="{{ route('costCenters.index') }}">Centros de Custo</a>

                        @if(is_null($costCenter->id))
                            > NOVA
                        @else
                            > {{ $costCenter->cpf_cnpj }} - {{ $costCenter->name }}
                        @endif
                    </h4>
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

            <form name="formulario" id="formulario" @if($mode == 'edit') action="{{ route('costCenters.update', ['id' => $costCenter->id]) }}" @else action="{{ route('costCenters.store')}}" @endIf method="POST">
                {{ csrf_field() }}

                <input type="hidden" name="id" value="{{$costCenter->id}}" >

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <label for="name">Nome</label>
                                    <input type="text" name="name" id="name" value="{{$costCenter->name}}"/>
                                </div>
                                <div class="row">
                                    <label for="code">Código</label>
                                    <input name="code" id="code" value="{{$costCenter->code}}"/>
                                </div>
                                <div class="row">
                                    <label for="parent_code">Código Superior</label>
                                    <input name="parent_code" id="parent_code" value="{{$costCenter->parent_code}}"/>
                                </div>
                                <div class="row">
                                    <label for="frequency">Frequência</label>
                                    <input type="text" name="frequency" id="frequency" value="{{$costCenter->frequency}}"/>
                                </div>
                                <div class="row">
                                    <label for="limit">Limite</label>
                                    <input type="text" name="limit" id="limit" value="{{$costCenter->limit}}"/>
                                </div>
                                <div class="row">
                                    <label for="can_accumulate">Acumulável</label>
                                    <input type="hidden" name="can_accumulate" value="false">
                                    <input type="checkbox" name="can_accumulate" id="can_accumulate" {{$costCenter->can_accumulate ? 'checked="checked"' : ''}}/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('partials.save-button')
            </form>
        </div>
    </div>
@endsection
