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

<table id="costCentersTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Nome</th>
        <th>Code</th>
        <th>Parent Code</th>
        <th>Frequência</th>
        <th>Limite</th>
        <th>Acumulável</th>
    </tr>
    </thead>

    @forelse ($costCenters as $costCenter)

        <tr>
            <td>
                <a href="{{ route('costCenters.show', ['id' => $costCenter->id]) }}">{{ $costCenter->name }}</a>
            </td>
            <td>
                {{ $costCenter->code }}
            </td>
            <td>
                {{ $costCenter->parent_code }}
            </td>
            <td>
                {{ $costCenter->frequency }}
            </td>
            <td>
                {{ $costCenter->limit }}
            </td>
            <td>
                {{ $costCenter->can_accumulate }}
            </td>
        </tr>
    @empty
        <p>Nenhum Centro de Custo encontrado</p>
    @endforelse
</table>
