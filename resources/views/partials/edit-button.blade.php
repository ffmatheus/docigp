@if(isset($model) && ! is_null($model->id))
    <button
        type="button"
        v-on:click.prevent="editButton()"
        class="btn btn-danger"
        id="vue-editButton"
        :disabled="isEditing || isCreating"
    >
        <i class="fas fa-pencil-alt"></i> Alterar
    </button>
@endif
