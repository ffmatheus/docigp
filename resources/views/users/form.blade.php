@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-8 col-md-10">
                    <h4>
                        <a href="{{ route('users.index') }}">Users</a>

                        @if(is_null($user->id))
                            > NOVO
                        @else
                            > {{ $user->name }}
                        @endif
                    </h4>
                </div>

                <div class="col-xs-4 col-md-2">
                    @include('partials.save-button')
                    @include('partials.edit-button', ['model' => $user])
                </div>
            </div>
        </div>

        <div class="panel-body">
            @include('partials.alerts')

            <form name="formulario" id="formulario" action="{{ route('users.store') }}" method="POST">
                {{ csrf_field() }}

                <input type="hidden" name="id" value="{{$user->id}}"/>

                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="username">Login ALERJ</label>
                                <input type="hidden" name="username" id="username" value="{{$user->username}}" />
                                <p><label for="email">{{$user->email}}</label></p>
                                <input type="hidden" name="email" id="email" value="{{$user->email}}" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <p><label name="name">{{$user->name}}</label></p>
                                <input type="hidden" name="name" id="name" value="{{$user->name}}" />
                            </div>
                        </div>
                    </div>
                </div>

                <select size="10" name="all-roles" id="all-roles" class="ui-widget-content ui-corner-all" style="width:250px;">
                    @foreach($allRoles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>

                <div class="buttons" align="center">
                    <br>
                    @include('users.partials.add-profile-button')
                    <br>
                    <br>
                    <input type="submit" name="ctl00$ConteudoPrincipal$btnRemover" value="< Remover" id="ctl00_ConteudoPrincipal_btnRemover" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" style="width:110px;">
                </div>

                <select size="10" name="assigned-roles" id="assigned-roles" class="ui-widget-content ui-corner-all" style="width:250px;">
                    @foreach($user->roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>

                @include('partials.save-button')
            </form>
        </div>
    </div>
@endsection
