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

<table id="uploadFilesTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Arquivo</th>
    </tr>
    </thead>

</table>
