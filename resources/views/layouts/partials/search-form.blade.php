<form action="{{ route($routeSearch) }}" id="searchForm">
    {{ csrf_field() }}

    <div class="form-group pull-right">
        <div class="row d-flex justify-content-end">
            <div class="col-xs-4">
                @if (isset($routeCreate))
                    <a href="{{ route($routeCreate) }}" class="btn btn-danger pull-right">
                        <i class="fa fa-plus"></i> Novo
                    </a>
                @endif


            </div>

            <div class="col-xs-8 d-flex justify-content-end">
                <div class="input-group">
                    <input class="form-control" name="pesquisa" placeholder="Pesquisar" value="{{request('pesquisa') ?? '' }}">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2" onClick="javascript:document.getElementById('searchForm').submit();">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>

            @if(isset($routeSearch))
                <div class="col-xs-8 d-flex justify-content-end">
                    <div class="input-group">
                        <a href="{{ route($routeSearch) }}" class="btn btn-primary pull-right">
                            <i class="fas fa-eraser"></i> Limpar
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</form>
