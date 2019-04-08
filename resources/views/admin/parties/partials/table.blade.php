@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

@if(session()->has('warning'))
    <div class="alert alert-warning">
        {{ session()->get('warning') }}
    </div>
@endif

<table id="partiesTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>Nome</th>
        <th>Sigla</th>
    </tr>
    </thead>

    @forelse ($parties['rows'] as $party)
        <tr>
            <td>
                <a href="{{ route('parties.show', ['id' => $party->id]) }}">
                {{ $party->id }}
                </a>
            </td>
            <td>
                {{$party->name}}
            </td>
            <td>
                {{$party->code}}
            </td>
        </tr>
    @empty
        <p>Nenhuma Legislatura encontrada</p>
    @endforelse
</table>
