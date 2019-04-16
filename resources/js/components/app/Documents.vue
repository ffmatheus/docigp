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
                v-if="can('entry-documents:create')"
                class="btn btn-primary btn-sm pull-right"
                @click="createDocument()"
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
                    {{ document.attached_file.original_name }}
                </td>

                <td
                    v-if="can('entry-documents:show')"
                    class="align-middle text-center"
                >
                    <app-active-badge
                        :value="document.analysed_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>

                <td
                    v-if="can('entry-documents:show')"
                    class="align-middle text-center"
                >
                    <app-active-badge
                        :value="document.published_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>

                <td class="align-middle text-right">
                    <button
                        v-if="
                            can('entry-documents:analyse') &&
                                !document.analysed_at &&
                                can('documents:update')
                        "
                        class="btn btn-sm btn-micro btn-primary"
                        @click="analyse(document)"
                        title="Marcar orçamento como 'analisado'"
                    >
                        <i class="fa fa-check"></i> analisado
                    </button>

                    <button
                        v-if="
                            can('entry-documents:analyse') &&
                                document.analysed_at &&
                                can('documents:update')
                        "
                        class="btn btn-sm btn-micro btn-danger"
                        @click="unanalyse(document)"
                        title="Cancelar marcação de 'em analisado'"
                    >
                        <i class="fa fa-ban"></i> analisado
                    </button>

                    <button
                        v-if="
                            can('entry-documents:publish') &&
                                document.analysed_at &&
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
                        v-if="
                            can('entry-documents:publish') &&
                                document.published_at &&
                                can('documents:update')
                        "
                        class="btn btn-sm btn-micro btn-danger"
                        @click="unpublish(document)"
                        title="Remover autorização de publicação"
                    >
                        <i class="fa fa-ban"></i> despublicar
                    </button>

                    <a
                        :href="document.url"
                        target="_blank"
                        title="Ver imagem do documento"
                        class="btn btn-sm btn-micro btn-warning cursor-pointer"
                    >
                        <i class="fa fa-file-image"></i>
                    </a>

                    <button
                        v-if="can('entry-documents:publish')"
                        class="btn btn-sm btn-micro btn-danger"
                        @click="trash(document)"
                        title="Deletar documento"
                        :disabled="document.analysed_at"
                    >
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        </app-table>

        <app-document-form :show.sync="showModal"></app-document-form>
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

            showModal: false,
        }
    },

    methods: {
        ...mapActions(service.name, ['selectEntryDocument']),

        getTableColumns() {
            let columns = ['Nome do arquivo']

            if (can('documents:show')) {
                columns.push({
                    type: 'label',
                    title: 'Analisado',
                    trClass: 'text-center',
                })

                columns.push({
                    type: 'label',
                    title: 'Publicado',
                    trClass: 'text-center',
                })
            }

            columns.push('')

            return columns
        },

        trash(document) {
            confirm('Deseja realmente DELETAR este documento?', this).then(
                value => {
                    value &&
                        this.$store.dispatch('entryDocuments/delete', document)
                },
            )
        },

        analyse(document) {
            confirm('Este documento está "EM CONFORMIDADE"?', this).then(
                value => {
                    value &&
                        this.$store.dispatch('entryDocuments/analyse', document)
                },
            )
        },

        unanalyse(document) {
            confirm(
                'Deseja remover o status "EM CONFORMIDADE" deste lançamento?',
                this,
            ).then(value => {
                value &&
                    this.$store.dispatch('entryDocuments/unanalyse', document)
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

        createDocument() {
            this.showModal = true
        },
    },
}
</script>
