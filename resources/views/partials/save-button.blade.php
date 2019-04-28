<button
    id="cancelButton"
    class="btn btn-success ml-1"
    v-on:click.prevent="cancel()"
    :disabled="!(isEditing || isCreating)"
>
    <i class="fas fa-ban"></i> Cancelar
</button>

<button
    type="submit"
    class="btn btn-outline-danger ml-1"
    @include('partials.disabled', ['model' => $model ?? null])
>
    <i class="fa fa-save"></i> Gravar
</button>
