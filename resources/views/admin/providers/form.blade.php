@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-8 col-md-10">
                    <h4>
                        <a href="{{ route('providers.index') }}">Fornecedores / Favorecidos</a>

                        @if(is_null($provider->id))
                            > NOVA
                        @else
                            > {{ $provider->cpf_cnpj }} - {{ $provider->name }}
                        @endif
                    </h4>
                </div>

                <div class="col-xs-4 col-md-2">
                    @include('partials.save-button')
                    @include('partials.edit-button', ['model' => $provider])
                </div>
            </div>
        </div>

        <div class="panel-body">
            @include('partials.alerts')
            @if ($errors->has('cpf_cnpj'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('cpf_cnpj') }}
                </div>
            @endif
            @if ($errors->has('type'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('type') }}
                </div>
            @endif
            @if ($errors->has('name'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('name') }}
                </div>
            @endif


            <form name="formulario" id="formulario" action="{{ route('providers.store') }}" method="POST">
                {{ csrf_field() }}

                <input type="hidden" name="id" value="{{$provider->id}}" >

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="col-md-12">
                            <div class="form-group">

                                <label for="cpf_cnpj">CPF / CNPJ</label>
                                <input type="text" name="cpf_cnpj" id="cpf_cnpj" value="{{$provider->cpf_cnpj}}"/>

                                <label for="type">Tipo Pessoa</label>
                                <select name="type" id="type">
                                    <option value="">Selecione</option>
                                    <option value="PF" {{$provider->type == 'PF' ? 'selected=selected' : ''}}>Pessoa Física</option>
                                    <option value="PJ" {{$provider->type == 'PJ' ? 'selected=selected' : ''}}>Pessoa Jurídica</option>
                                </select>

                                <label for="name">Nome</label>
                                <input type="text" name="name" id="name" value="{{$provider->name}}"/>

                            </div>
                        </div>
                    </div>
                </div>

                @include('partials.save-button')
            </form>
        </div>
    </div>
@endsection
