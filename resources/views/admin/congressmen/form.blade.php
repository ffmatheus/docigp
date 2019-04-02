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
                            > {{ $congressman->number }}
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
                        <label for="number">Número</label>
                        <input name="number" value="{{is_null(old('number')) ? $congressman->number : old('number')}}" class="form-control" id="number" aria-describedby="numberHelp" placeholder="number" >
                    </div>

                </div>

                @include('partials.save-button')
            </form>
        </div>
    </div>
@endsection
