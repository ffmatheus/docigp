@extends('layouts.app')

@section('content')
<div class="container-fluid" id="vue-admin">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Painel de Controle</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="btn btn-primary btn-lg p-5 m-lg-5" href="{{ route('entries.index') }}">
                        Prestação de Contas
                    </a>
                    <a class="btn btn-primary btn-lg p-5 m-lg-5" href="{{ route('parties.index') }}">
                        Partidos
                    </a>
                    <a class="btn btn-primary btn-lg p-5 m-lg-5" href="{{ route('legislatures.index') }}">
                        Legislaturas
                    </a>
                    <a class="btn btn-primary btn-lg p-5 m-lg-5" href="{{ route('congressmen.index') }}">
                        Deputados
                    </a>
                    <a class="btn btn-primary btn-lg p-5 m-lg-5" href="{{ route('users.index') }}">
                        Usuários
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
