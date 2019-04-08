@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-8 col-md-10">
                    <h4>
                        <a href="{{ route('parties.index') }}">Partidos</a>

                        @if(is_null($party->id))
                            > NOVO
                        @else
                            > {{ $party->number }}
                        @endif
                    </h4>
                </div>

                <div class="col-xs-4 col-md-2">
                    @include('partials.save-button')
                </div>
            </div>
        </div>

        <div class="panel-body">
            @include('partials.alerts')

            <form name="formulario" id="formulario" action="{{ route('parties.store') }}" method="POST">
                {{ csrf_field() }}

                <input name="id" type='hidden' value="{{$party->id}}" id="id" >

                <div class="row">
                    <div class="form-group col-md-6" >
                        <label for="name">Nome</label>
                        <input name="name" value="{{is_null(old('name')) ? $party->name : old('name')}}" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Nome" >
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6" >
                        <label for="code">SIGLA</label>
                        <input name="code" value="{{is_null(old('name')) ? $party->name : old('name')}}" class="form-control" id="code" aria-describedby="nameHelp" placeholder="Sigla" >
                    </div>

                </div>

                @include('partials.save-button')
            </form>
        </div>
    </div>
@endsection
