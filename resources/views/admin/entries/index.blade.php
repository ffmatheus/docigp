@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col text-right">
            <a href="/files/docigp.pdf" class="btn btn-primary btn-sm" download>
                <i class="fa fa-cloud-download-alt"></i> Baixar Ato Nº 641/2019
            </a>
        </div>
    </div>

    <div class="container-fluid" id="vue-entries">
        <app-account></app-account>
    </div>
@endsection
