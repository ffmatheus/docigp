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

<table id="congressmenTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Número</th>
    </tr>
    </thead>

    @forelse ($congressmen as $congressman)
        <tr>
            <td>
                <a href="{{ route('congressmen.show', ['id' => $congressman->id]) }}">{{ $congressman->number }}</a>
            </td>
        </tr>
    @empty
        <p>Nenhum Deputado encontrado</p>
    @endforelse
</table>
