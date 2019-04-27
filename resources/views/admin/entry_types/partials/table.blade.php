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

<table id="entryTypesTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Nome</th>
        <th>Requer documento</th>
    </tr>
    </thead>

    @forelse ($entryTypes as $entryType)
        <tr>
            <td>
                <a href="{{ route('entryTypes.show', ['id' => $entryType->id]) }}">{{ $entryType->name }}</a>
            </td>
            <td>
                @if ($entryType->document_number_required)
                    <label class="badge badge-success"> Sim </label>
                @else
                    <label class="badge badge-danger"> Não </label>
                @endif
            </td>
        </tr>
    @empty
        <p>Nenhum Tipo de Lançamento encontrado</p>
    @endforelse
</table>
