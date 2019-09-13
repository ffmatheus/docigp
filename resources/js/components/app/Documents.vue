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
                v-if="
                    can('entry-documents:buttons') ||
                        can('entry-documents:store')
                "
                :disabled="!can('entry-documents:store')"
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
                        :value="document.verified_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
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
                        :labels="['documento público', 'documento privado']"
                    ></app-active-badge>
                </td>

                <td class="align-middle text-right">
                    <button
                        v-if="
                            (can('entry-documents:buttons') ||
                                can('entry-documents:verify')) &&
                                !document.verified_at
                        "
                        :disabled="!can('entry-documents:verify')"
                        class="btn btn-sm btn-micro btn-primary"
                        @click="verify(document)"
                        title="Marcar como verificado"
                    >
                        <i class="fa fa-check"></i> verificar
                    </button>

                    <button
                        v-if="
                            (can('entry-documents:buttons') ||
                                can('entry-documents:verify')) &&
                                document.verified_at
                        "
                        :disabled="!can('entry-documents:verify')"
                        class="btn btn-sm btn-micro btn-warning"
                        @click="unverify(document)"
                        title="Cancelar verificação"
                    >
                        <i class="fa fa-ban"></i> verificação
                    </button>

                    <button
                        v-if="
                            can('entry-documents:analyse') &&
                                !document.analysed_at &&
                                document.verified_at
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
                                document.analysed_at
                        "
                        class="btn btn-sm btn-micro btn-danger"
                        @click="unanalyse(document)"
                        title="Cancelar status de 'analisado'"
                    >
                        <i class="fa fa-ban"></i> analisado
                    </button>

                    <button
                        v-if="
                            (can('entry-documents:buttons') ||
                                can('entry-documents:publish')) &&
                                !document.published_at &&
                                document.verified_at
                        "
                        :disabled="!can('entry-documents:publish')"
                        class="btn btn-sm btn-micro btn-danger"
                        @click="publish(document)"
                        title="Marcar como 'publicável'"
                    >
                        <i class="fa fa-check"></i> tornar público
                    </button>

                    <button
                        v-if="
                            (can('entry-documents:buttons') ||
                                can('entry-documents:publish')) &&
                                document.published_at
                        "
                        :disabled="!can('entry-documents:publish')"
                        class="btn btn-sm btn-micro btn-success"
                        @click="unpublish(document)"
                        title="Remover autorização de publicação"
                    >
                        <i class="fa fa-ban"></i> tornar privado
                    </button>

                    <a
                        :href="document.url"
                        target="_blank"
                        title="Visualizar documento"
                        class="btn btn-sm btn-micro btn-warning cursor-pointer"
                    >
                        <i class="fa fa-eye"></i>
                    </a>

                    <button
                        v-if="
                            can('entry-documents:buttons') ||
                                can('entry-documents:delete')
                        "
                        :disabled="
                            !can('entry-documents:delete') ||
                                document.analysed_at ||
                                document.published_at ||
                                congressmanBudgetsClosedAt
                        "
                        class="btn btn-sm btn-micro btn-danger"
                        @click="trash(document)"
                        title="Deletar documento"
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
import { mapActions, mapGetters } from 'vuex'
import crud from '../../views/mixins/crud'
import entries from '../../views/mixins/entries'
import permissions from '../../views/mixins/permissions'
import entryDocuments from '../../views/mixins/entryDocuments'
import congressmanBudgets from '../../views/mixins/congressmanBudgets'

const service = {
    name: 'entryDocuments',

    uri:
        'congressmen/{congressmen.selected.id}/budgets/{congressmanBudgets.selected.id}/entries/{entries.selected.id}/documents',
}

export default {
    mixins: [crud, entryDocuments, permissions, entries, congressmanBudgets],

    data() {
        return {
            service: service,

            showModal: false,
        }
    },

    computed: {
        ...mapGetters({
            congressmanBudgetsClosedAt: 'congressmanBudgets/selectedClosedAt',
        }),

        // return this.$store.dispatch('congressmanBudgets/changePercentage', {
        //     congressmanBudget: congressmanBudget,
        //     percentage: value
        // });
    },

    methods: {
        ...mapActions(service.name, ['selectEntryDocument']),

        getTableColumns() {
            let columns = ['Nome do arquivo']

            if (can('entry-documents:show')) {
                columns.push({
                    type: 'label',
                    title: 'Verificado',
                    trClass: 'text-center',
                })

                columns.push({
                    type: 'label',
                    title: 'Analisado',
                    trClass: 'text-center',
                })

                columns.push({
                    type: 'label',
                    title: 'Publicidade',
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

        verify(entry) {
            confirm(
                'Confirma a marcação deste lançamento como "VERIFICADO"?',
                this,
            ).then(value => {
                value && this.$store.dispatch('entryDocuments/verify', entry)
            })
        },

        unverify(entry) {
            confirm(
                'O status de "VERIFICADO" será removido deste lançamento, confirma?',
                this,
            ).then(value => {
                value && this.$store.dispatch('entryDocuments/unverify', entry)
            })
        },

        analyse(document) {
            confirm('Este documento foi ANALISADO?', this).then(value => {
                value &&
                    this.$store.dispatch('entryDocuments/analyse', document)
            })
        },

        unanalyse(document) {
            confirm(
                'Deseja remover o status "ANALISADO" deste lançamento?',
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
