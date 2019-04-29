<a href="{{route($url)}}"
    id="cancelButton"
    class="btn btn-success ml-1"
>
    <i class="fas fa-ban"></i> Cancelar
</a>

<button
    type="submit"
    class="btn btn-outline-danger ml-1"
    @include('partials.disabled', ['model' => $model ?? null])
>
    <i class="fa fa-save"></i> Gravar
</button>
