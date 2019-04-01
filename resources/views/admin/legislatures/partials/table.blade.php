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

<table id="legislaturesTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Número</th>
    </tr>
    </thead>

    @forelse ($legislatures as $legislature)
        <tr>
            <td>
                <a href="{{ route('legislatures.show', ['id' => $legislature->id]) }}">{{ $legislature->number }}</a>
            </td>
        </tr>
    @empty
        <p>Nenhuma Legislatura encontrada</p>
    @endforelse
</table>
