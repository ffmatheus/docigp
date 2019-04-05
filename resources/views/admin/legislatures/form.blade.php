@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-8 col-md-10">
                    <h4>
                        <a href="{{ route('legislatures.index') }}">Legislaturas</a>

                        @if(is_null($legislature->id))
                            > NOVA
                        @else
                            > {{ $legislature->number }}
                        @endif
                    </h4>
                </div>

                <div class="col-xs-4 col-md-2">
                    @include('partials.save-button')
                    @include('partials.edit-button', ['model' => $legislature])
                </div>
            </div>
        </div>

        <div class="panel-body">
            @include('partials.alerts')
            @if ($errors->has('number'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('number') }}
                </div>
            @endif
            @if ($errors->has('year_start'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('year_start') }}
                </div>
            @endif
            @if ($errors->has('year_end'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('year_end') }}
                </div>
            @endif


            <form name="formulario" id="formulario" action="{{ route('legislatures.store') }}" method="POST">
                {{ csrf_field() }}

                <input type="hidden" name="id" value="{{$legislature->id}}" >

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="col-md-12">
                            <div class="form-group">

                                <label for="username">Número</label>
                                <input type="text" name="number" id="number" value="{{$legislature->number}}"/>

                                <label for="name">Ano início</label>
                                <input type="text" name="year_start" id="year_start" value="{{$legislature->year_start}}"/>

                                <label for="name">Ano fim</label>
                                <input type="text" name="year_end" id="year_end" value="{{$legislature->year_end}}"/>

                            </div>
                        </div>
                    </div>
                </div>

                @include('partials.save-button')
            </form>
        </div>
    </div>
@endsection
