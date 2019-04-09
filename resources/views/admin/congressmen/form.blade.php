@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <div class="row">
                <div class="col-xs-8 col-md-10">
                    <h4 class="mb-0">
                        <a href="{{ route('congressmen.index') }}">Deputados</a>

                        @if(is_null($congressman->id))
                            > NOVA
                        @else
                            > {{ $congressman->name }}
                        @endif
                    </h4>
                </div>

                <div class="col-xs-4 col-md-2 text-right">
                    {{--@include('partials.save-button')--}}
                </div>
            </div>
        </div>

        <div class="card-body">
            @include('partials.alerts')

            <form name="formulario" id="formulario" action="{{ route('congressmen.store') }}" method="POST">
                {{ csrf_field() }}

                <input name="id" type='hidden' value="{{$congressman->id}}" id="id" >
                <div class="row">
                    <div class="form-group col-md-6" >
                        <img src="{{'http://'.trim($congressman->photo_url)}}">
                    </div>
                </div>

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
                        {{--{{dump($parties)}}--}}
                        {{--@foreach($parties as $key =>$party)--}}
                        {{--{{dump($party)}}--}}
                        {{--@endforeach--}}
                        {{--{{dd("fim")}}--}}
                        {{--<select name="party_id" id="party_id" class="form-control">--}}
                            {{--<option value="">Selecione</option>--}}

                            {{--@foreach($parties as $key =>$party)--}}
                                {{--<option value="{{ $party->id }}">{{ $party->name }}</option>--}}
                        {{--</select>--}}
                        {{--@endforeach--}}
                        <input nickname="party" value="{{is_null(old('party_name')) ? $congressman->party->name : old('party_name')}}" class="form-control" id="party" aria-describedby="nicknameHelp" placeholder="party_name" >
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6" >
                        <label for="email">Email:</label>
                        <input nickname="email" value="{{is_null(old('email')) ? $congressman->email : old('email')}}" class="form-control" id="email" aria-describedby="emailHelp" placeholder="email" >
                    </div>

                </div>



                @include('partials.save-button')
            </form>
        </div>
    </div>
@endsection
