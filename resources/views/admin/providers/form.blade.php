@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-8 align-self-center">
                    <h4 class="mb-0">
                        <a href="{{ route('providers.index') }}">Favorecidos</a>

                        @if(is_null($provider->id))
                            > NOVA
                        @else
                            > {{ $provider->cpf_cnpj }} - {{ $provider->name }}
                        @endif
                    </h4>
                </div>
            </div>
        </div>

        <div class="card-body">
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
                                <input class="form-control" name="cpf_cnpj" id="cpf_cnpj" value="{{$provider->cpf_cnpj}}"/>
                            </div>

                            <div class="form-group">
                                <label for="type">Tipo Pessoa</label>
                                <select class="custom-select" name="type" id="type">
                                    <option value="">Selecione</option>
                                    <option value="PF" {{$provider->type == 'PF' ? 'selected=selected' : ''}}>Pessoa Física</option>
                                    <option value="PJ" {{$provider->type == 'PJ' ? 'selected=selected' : ''}}>Pessoa Jurídica</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input class="form-control" name="name" id="name" value="{{$provider->name}}"/>
                            </div>
                        </div>
                    </div>
                </div>
                @include('partials.save-button')
            </form>
        </div>
    </div>
@endsection
