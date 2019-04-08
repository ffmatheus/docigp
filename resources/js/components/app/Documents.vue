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
        :subTitle="
            entries.selected.object + ' - ' + entries.selected.value_formatted
        "
    >
        <template slot="buttons">
            <button
                class="btn btn-primary btn-sm pull-right"
                @click="createEntry()"
                title="Novo documento"
            >
                <i class="fa fa-plus"></i>
            </button>
        </template>

        <app-table
            :pagination="pagination"
            @goto-page="gotoPage($event)"
            :columns="getTableColumns()"
        >
            <tr
                @click="selectEntryDocument(document)"
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

                <td
                    v-if="can('documents:update')"
                    class="align-middle text-center"
                >
                    <app-active-badge
                        :value="document.complied_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>

                <td
                    v-if="can('documents:update')"
                    class="align-middle text-center"
                >
                    <app-active-badge
                        :value="document.published_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>

                <td class="align-middle text-right">
                    <button
                        v-if="!document.complied_at && can('documents:update')"
                        class="btn btn-sm btn-micro btn-primary"
                        @click="comply(document)"
                        title="Marcar orçamento como 'em conformidade'"
                    >
                        <i class="fa fa-check"></i> conforme
                    </button>

                    <button
                        v-if="document.complied_at && can('documents:update')"
                        class="btn btn-sm btn-micro btn-danger"
                        @click="uncomply(document)"
                        title="Cancelar marcação de 'em conformidade'"
                    >
                        <i class="fa fa-ban"></i> conformidade
                    </button>

                    <button
                        v-if="
                            document.complied_at &&
                                !document.published_at &&
                                can('documents:update')
                        "
                        class="btn btn-sm btn-micro btn-info"
                        @click="publish(document)"
                        title="Marcar como 'publicável'"
                    >
                        <i class="fa fa-check"></i> publicar
                    </button>

                    <button
                        v-if="document.published_at && can('documents:update')"
                        class="btn btn-sm btn-micro btn-danger"
                        @click="unpublish(document)"
                        title="Remover autorização de publicação"
                    >
                        <i class="fa fa-ban"></i> despublicar
                    </button>

                    <a
                        href="/img/docigp.pdf"
                        target="_blank"
                        class="btn btn-sm btn-micro btn-warning cursor-pointer"
                    >
                        <i class="fa fa-file-image"></i>
                    </a>

                    <button
                        v-if="can('documents:update')"
                        class="btn btn-sm btn-micro btn-danger"
                        @click="trash(document)"
                        title="Deletar documento"
                        :disabled="document.complied_at"
                    >
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        </app-table>
    </app-table-panel>
</template>

<script>
import { mapActions } from 'vuex'
import crud from '../../views/mixins/crud'
import entries from '../../views/mixins/entries'
import permissions from '../../views/mixins/permissions'
import entryDocuments from '../../views/mixins/entryDocuments'

const service = {
    name: 'entryDocuments',

    uri:
        'congressmen/{congressmen.selected.id}/budgets/{congressmanBudgets.selected.id}/entries/{entries.selected.id}/documents',
}

export default {
    mixins: [crud, entryDocuments, permissions, entries],

    data() {
        return {
            service: service,
        }
    },

    methods: {
        ...mapActions(service.name, ['selectEntryDocument']),

        getTableColumns() {
            let columns = ['Name', '']

            if (can('documents:update')) {
                columns.push({
                    type: 'label',
                    title: 'Conforme',
                    trClass: 'text-center',
                })

                columns.push({
                    type: 'label',
                    title: 'Publicado',
                    trClass: 'text-center',
                })
            }

            columns.push('')
        },

        trash(document) {},

        comply(document) {
            confirm('Este documento está "EM CONFORMIDADE"?', this).then(
                value => {
                    value &&
                        this.$store.dispatch('entryDocuments/comply', document)
                },
            )
        },

        uncomply(document) {
            confirm(
                'Deseja remover o status "EM CONFORMIDADE" deste lançamento?',
                this,
            ).then(value => {
                value &&
                    this.$store.dispatch('entryDocuments/uncomply', document)
            })
        },

        publish(document) {
            confirm('Confirma a PUBLICAÇÃO deste documento?', this).then(
                value => {
                    value &&
                        this.$store.dispatch('entryDocuments/publish', document)
                },
            )
        },

        unpublish(document) {
            confirm('Confirma a DESPUBLICAÇÃO deste documento?', this)
                .then(this)
                .then(value => {
                    value &&
                        this.$store.dispatch(
                            'entryDocuments/unpublish',
                            document,
                        )
                })
        },
    },
}
</script>
