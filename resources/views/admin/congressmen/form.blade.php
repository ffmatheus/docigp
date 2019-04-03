@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-8 col-md-10">
                    <h4>
                        <a href="{{ route('congressmen.index') }}">Deputados</a>

                        @if(is_null($congressman->id))
                            > NOVA
                        @else
                            > {{ $congressman->name }}
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

            <form name="formulario" id="formulario" action="{{ route('congressmen.store') }}" method="POST">
                {{ csrf_field() }}

                <input name="id" type='hidden' value="{{$congressman->id}}" id="id" >

                <div class="row">
                    <div class="form-group col-md-6" >
                        <label for="name">Nome</label>
                        <input name="name" value="{{is_null(old('name')) ? $congressman->name : old('name')}}" class="form-control" id="name" aria-describedby="nameHelp" placeholder="name" >
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6" >
                        <label for="nickname">Nome Público</label>
                        <input nickname="nickname" value="{{is_null(old('nickname')) ? $congressman->nickname : old('nickname')}}" class="form-control" id="nickname" aria-describedby="nicknameHelp" placeholder="nickname" >
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6" >
                        <label for="nickname">Partido</label>
                        <select name="party_id" id="party_id" class="form-control">
                            <option value="">SELECTIONE</option>
                            <option value="1">PSOL</option>
                        </select>
                    </div>

                </div>



                @include('partials.save-button')
            </form>
        </div>
    </div>
@endsection
