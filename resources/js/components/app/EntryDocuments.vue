<template>
    <app-table-panel
        :title="'Documentos (' + pagination.total + ')'"
        titleCollapsed="Documento"
        :per-page="perPage"
        :filter-text="filterText"
        @input-filter-text="filterText = $event.target.value"
        @set-per-page="perPage = $event"
        :collapsedLabel="selected.name"
        :is-selected="selected.id !== null"
    >
        <app-table
            :pagination="pagination"
            @goto-page="gotoPage($event)"
            :columns="[
                'Name',
                {
                    type: 'label',
                    title: 'Publicado',
                    trClass: 'text-center',
                },
                '',
            ]"
        >
            <tr
                @click="select(document)"
                v-for="document in entryDocuments.data.rows"
                :class="{
                    'cursor-pointer': true,
                    'bg-primary-lighter text-white': isCurrent(
                        document,
                        selected,
                    ),
                }"
            >
                <td class="align-middle">
                    {{ document.name.substring(1, 10) }}
                </td>

                <td class="align-middle text-center">
                    <app-active-badge
                        :value="document.published_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>

                <td class="align-middle text-right">
                    <button class="btn btn-sm btn-micro btn-danger">
                        publicar
                    </button>

                    <button class="btn btn-sm btn-micro btn-warning">
                        <i class="fa fa-file-image"></i>
                    </button>
                </td>
            </tr>
        </app-table>
    </app-table-panel>
</template>

<script>
import crud from '../../views/mixins/crud'
import permissions from '../../views/mixins/permissions'
import entryDocuments from '../../views/mixins/entryDocuments'

export default {
    mixins: [crud, entryDocuments, permissions],

    data() {
        return {
            service: {
                name: 'entryDocuments',

                uri:
                    'congressmen/{congressmen.selected.id}/budgets/{congressmanBudgets.selected.id}/entries/{entries.selected.id}/documents',
            },
        }
    },

    methods: {
        makeDate(entryDocument) {
            return entryDocument.year + ' / ' + entryDocument.month
        },
    },
}
</script>
