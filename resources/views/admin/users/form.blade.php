@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="vue-users">
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
                    </div>
                </div>
            </div>

            <div class="panel-body">

                <form name="formUsers" id="formUsers" action="{{ route('users.update', ['id' => $user->id]) }}" method="POST">
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

                    <input name="roles_array" id="roles_array" type="hidden" v-model="rolesJsonString">

                    <div class="row">
                        <div class="form-group col-md-3">
                            <select size="10" name="all-roles" id="all-roles" class="ui-widget-content ui-corner-all" style="width:250px;">
                                @foreach($allRoles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
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
                                    <option value="{{$role->id}}">{{$role->name}}</option>
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
