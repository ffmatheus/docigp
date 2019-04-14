@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="vue-users">
        <div class="card card-default">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 align-self-center">
                        <h4>
                            <a href="{{ route('users.index') }}">Usuários</a>

                            @if(is_null($user->id))
                                > NOVO
                            @else
                                > {{ $user->name }}
                            @endif
                        </h4>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @include('partials.alerts')

                @if ($errors->has('email'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <form name="formUsers" id="formUsers" @if($mode == 'edit') action="{{ route('users.update', ['id' => $user->id]) }}" @else action="{{ route('users.store')}}" @endIf method="POST">
                    {{ csrf_field() }}

                    <input type="hidden" name="id" value="{{$user->id}}"/>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="username">E-mail ALERJ</label>
                                    <input class="form-control" disabled="{{ $mode == 'edit' ? 'disabled' : '' }}" name="email" id="email" value="{{$user->email}}" />
                                </div>
                            </div>

                            @if($mode == 'edit')
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input class="form-control" disabled="{{ $mode == 'edit' ? 'disabled' : '' }}" name="name" id="name" value="{{$user->name}}" />
                                    </div>
                                </div>
                            @endIf
                        </div>
                    </div>

                    <input name="roles_array" id="roles_array" type="hidden" v-model="rolesJsonString">

                    <div class="row">
                        <div class="form-group col-md-3">
                            <select size="10" name="all-roles" id="all-roles" class="ui-widget-content ui-corner-all" style="width:250px;">
                                @foreach($assignableRoles as $role)
                                    <option value="{{$role->id}}">{{$role->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3" align="center">
                            <br>
                            <a href="#" id="add-profile-button" class="btn btn-primary pull-right" v-on:click="f_add($event)">Adicionar ></a>
                            <br>
                            <br>
                            <a href="#" id="remove-profile-button" class="btn btn-primary pull-right" v-on:click="f_remove($event)">Remove <</a>
                        </div>

                        <div class="form-group col-md-3">
                            <select multiple size="10" name="assigned-roles" id="assigned-roles" class="ui-widget-content ui-corner-all" style="width:250px;">
                                @foreach($user->roles as $role)
                                    <option value="{{$role->id}}">{{$role->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @include('partials.save-button')
                </form>
            </div>
        </div>
    </div>
@endsection
