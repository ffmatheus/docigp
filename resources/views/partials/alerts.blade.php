@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<<<<<<< HEAD
@if ($alerts = session('alerts'))
    @foreach($alerts as $alert)
        <div class="alert alert-{{ $alert['type'] }}">
            {{ $alert['message'] }}
        </div>
    @endforeach
@endif
=======
>>>>>>> Users roles crud
