@if (session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

@if (session()->has('warning'))
    <div class="alert alert-warning">
        {{ session()->get('warning') }}
    </div>
@endif

<table id="congressmanLegislatures" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Deputado</th>
            <th>Legislatura</th>
            <th>Data início</th>
            <th>Data Fim</th>

        </tr>
    </thead>

    <tbody>

        @forelse ($congressmanLegislatures as $congressman)
            <tr>
                <td>
                    {{$congressman->id}}
                </td>

                <td>
                    {{$congressman->congressman->name}}
                </td>

                <td>
                    {{ $congressman->legislature->number}}
                </td>

                <td>
                    {{ $congressman->started_at}}
                </td>

                <td>
                    {{ $congressman->ended_at}}
                </td>
            </tr>
        @empty
            <p>Nenhum Deputado encontrado</p>
        @endforelse
    </tbody>
</table>


