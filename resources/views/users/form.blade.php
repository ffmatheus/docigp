@extends('layouts.app')


@section('content')
    <div class="container-fluid" id="vue-users">
        <app-users-form></app-users-form>
    </div>
@endsection

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
                        <button  type="button" v-on:click="editButton()" class="btn btn-danger" id="vue-editButton">
                            <i class="fas fa-pencil-alt"></i> Alterar
                        </button>
                    </div>
                </div>
            </div>

            <div class="panel-body">

                <form name="formUsers" id="formUsers" action="{{ route('users.store') }}" method="POST">
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

                </form>


                    <div class="row">
                        <div class="form-group col-md-2">
                            <select size="10" name="all-roles" id="all-roles" class="ui-widget-content ui-corner-all" style="width:250px;">
                                @foreach($allRoles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <br>
                            <a href="#" id="add-profile-button" class="btn btn-primary pull-right" v-on:click="f_add($event)">Adicionar ></a>
                            <br>
                            <br>
                            <a href="#" id="remove-profile-button" class="btn btn-primary pull-right" v-on:click="f_remove($event)">Remove <</a>
                        </div>

                        <div class="form-group col-md-2">
                            <select multiple size="10" name="assigned-roles" id="assigned-roles" class="ui-widget-content ui-corner-all" style="width:250px;">
                                @foreach($user->roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                <button class="btn btn-danger" v-on:click="submitForm()">
                    <i class="far fa-save"></i> Gravar
                </button>
            </div>
        </div>
@endsection
