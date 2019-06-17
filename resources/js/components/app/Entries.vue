<template>
    <app-table-panel
        :title="'Lançamentos (' + pagination.total + ')'"
        titleCollapsed="Lançamento"
        :subTitle="
            congressmen.selected.name + ' - ' + congressmanBudgetsSummaryLabel
        "
        :per-page="perPage"
        :filter-text="filterText"
        @input-filter-text="filterText = $event.target.value"
        @set-per-page="perPage = $event"
        :collapsedLabel="
            selected.date_formatted +
                ' - ' +
                selected.object +
                ' - ' +
                selected.value_formatted
        "
        :is-selected="selected.id !== null"
    >
        <template slot="widgets" v-if="can('entries:show')">
            <div class="mr-2">
                <span
                    class="btn btn-sm m-2"
                    :class="{
                        'btn-outline-success':
                            congressmanBudgets.selected.balance >= 0,
                        'btn-outline-danger':
                            congressmanBudgets.selected.balance < 0,
                    }"
                >
                    saldo acumulado |
                    {{ congressmanBudgets.selected.balance_formatted }}
                </span>
            </div>
        </template>

        <template slot="buttons">
            <button
                v-if="can('entries:buttons') || can('entries:store')"
                :disabled="!can('entries:store')"
                class="btn btn-primary btn-sm pull-right"
                @click="createEntry()"
                title="Nova despesa"
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
                @click="selectEntry(entry)"
                v-for="entry in entries.data.rows"
                :class="{
                    'cursor-pointer': true,
                    'bg-primary-lighter text-white': isCurrent(entry, selected),
                }"
            >
                <td class="align-middle">{{ entry.date_formatted }}</td>

                <td class="align-middle">
                    {{ entry.object }}<br />
                    <span>
                        <small class="text-primary">
                            {{ entry.cost_center_code }} -
                            {{ entry.cost_center_name_formatted }}
                        </small>
                    </span>
                </td>

                <td class="align-middle">
                    {{ entry.name }}
                    <span v-if="entry.cpf_cnpj">
                        <br />
                        <small class="text-primary">
                            {{ entry.cpf_cnpj }}
                        </small>
                    </span>
                </td>

                <td class="align-middle text-right">
                    {{ entry.documents_count }}
                </td>

                <td class="align-middle text-right">
                    {{ entry.value_formatted }}
                </td>

                <td v-if="can('entries:show')" class="align-middle text-center">
                    <span
                        :class="
                            'badge badge-' +
                                (entry.value > 0 ? 'success' : 'dark')
                        "
                    >
                        {{ isCreditEntry(entry) > 0 ? 'crédito' : 'débito' }}
                    </span>
                </td>

                <td v-if="can('entries:show')" class="align-middle text-center">
                    <span
                        class="
                            badge badge-primary"
                    >
                        {{
                            entry.entry_type_name +
                                (entry.document_number
                                    ? ': ' + entry.document_number
                                    : '')
                        }}
                    </span>
                </td>

                <td
                    v-if="can('congressman-budgets:show')"
                    class="align-middle text-center"
                >
                    <app-badge
                        v-if="entry.pendencies.length === 0"
                        caption="não"
                        color="#38c172,#FFFFFF"
                        padding="1"
                    ></app-badge>

                    <app-badge
                        v-if="entry.pendencies.length > 0"
                        color="#e3342f,#FFFFFF"
                        padding="1"
                    >
                        <span v-for="pendency in entry.pendencies">
                            &bull; {{ pendency }}<br />
                        </span>
                    </app-badge>
                </td>

                <td v-if="can('entries:show')" class="align-middle text-center">
                    <app-active-badge
                        :value="entry.verified_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>

                <td v-if="can('entries:show')" class="align-middle text-center">
                    <app-active-badge
                        :value="entry.analysed_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>

                <td v-if="can('entries:show')" class="align-middle text-center">
                    <app-active-badge
                        :value="entry.published_at"
                        :labels="['público', 'privado']"
                    ></app-active-badge>
                </td>

                <td class="align-middle text-right">
                    <div
                        v-if="
                            !congressmanBudgets.selected.closed_at ||
                                can('congressman-budgets:reopen')
                        "
                    >
                        <button
                            v-if="
                                (can('entries:buttons') ||
                                    can('entries:verify')) &&
                                    !entry.verified_at &&
                                    !entry.has_pendency
                            "
                            :disabled="!can('entries:verify')"
                            class="btn btn-sm btn-micro btn-primary"
                            @click="verify(entry)"
                            title="Marcar como verificado"
                        >
                            <i class="fa fa-check"></i> verificar
                        </button>

                        <button
                            v-if="
                                (can('entries:buttons') ||
                                    can('entries:verify')) &&
                                    entry.verified_at
                            "
                            :disabled="!can('entries:verify')"
                            class="btn btn-sm btn-micro btn-warning"
                            @click="unverify(entry)"
                            title="Cancelar verificação"
                        >
                            <i class="fa fa-ban"></i> verificação
                        </button>

                        <button
                            v-if="
                                can('entries:analyse') &&
                                    entry.verified_at &&
                                    !entry.analysed_at
                            "
                            class="btn btn-sm btn-micro btn-success"
                            @click="analyse(entry)"
                            title="Marcar como 'analisado'"
                        >
                            <i class="fa fa-check"></i> analisado
                        </button>

                        <button
                            v-if="
                                can('entries:analyse') &&
                                    entry.verified_at &&
                                    entry.analysed_at
                            "
                            class="btn btn-sm btn-micro btn-danger"
                            @click="unanalyse(entry)"
                            title="Cancelar status de 'analisado'"
                        >
                            <i class="fa fa-ban"></i> analisado
                        </button>

                        <button
                            v-if="
                                can('entries:publish') &&
                                    entry.analysed_at &&
                                    !entry.published_at
                            "
                            class="btn btn-sm btn-micro btn-danger"
                            title="Publicar no Portal da Transparência"
                            @click="publish(entry)"
                        >
                            <i class="fa fa-check"></i> publicar
                        </button>

                        <button
                            v-if="can('entries:publish') && entry.published_at"
                            class="btn btn-sm btn-micro btn-danger"
                            title="Remover do Portal da Transparência"
                            @click="unpublish(entry)"
                        >
                            <i class="fa fa-ban"></i> despublicar
                        </button>

                        <button
                            v-if="
                                can('entries:buttons') || can('entries:update')
                            "
                            :disabled="entry.analysed_at || entry.verified_at"
                            class="btn btn-sm btn-micro btn-primary"
                            @click="editEntry(entry)"
                            title="editar lançamento"
                        >
                            <i class="fa fa-edit"></i>
                        </button>

                        <button
                            v-if="
                                can('entries:buttons') || can('entries:delete')
                            "
                            :disabled="
                                !can('entries:delete') ||
                                    entry.analysed_at ||
                                    entry.verified_at
                            "
                            class="btn btn-sm btn-micro btn-danger"
                            @click="trash(entry)"
                            title="deletar lançamento"
                        >
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        </app-table>

        <app-entry-form :show.sync="showModal"></app-entry-form>
    </app-table-panel>
</template>

<script>
import crud from '../../views/mixins/crud'
import { mapActions, mapGetters } from 'vuex'
import entries from '../../views/mixins/entries'
import congressmen from '../../views/mixins/congressmen'
import permissions from '../../views/mixins/permissions'
import congressmanBudgets from '../../views/mixins/congressmanBudgets'

const service = {
    name: 'entries',

    uri:
        'congressmen/{congressmen.selected.id}/budgets/{congressmanBudgets.selected.id}/entries',
}

export default {
    mixins: [crud, entries, permissions, congressmanBudgets, congressmen],

    data() {
        return {
            service: service,

            showModal: false,
        }
    },

    methods: {
        ...mapActions(service.name, [
            'selectEntry',
            'clearForm',
            'clearErrors',
        ]),

        isCreditEntry(entry) {
            return entry.value > 0
        },

        getTableColumns() {
            let columns = [
                'Data',
                'Objeto',
                'Favorecido',
                {
                    type: 'label',
                    title: 'Documentos',
                    trClass: 'text-right',
                },
                {
                    type: 'label',
                    title: 'Valor',
                    trClass: 'text-right',
                },
            ]

            if (can('entries:show')) {
                columns.push({
                    type: 'label',
                    title: 'Tipo',
                    trClass: 'text-center',
                })

                columns.push({
                    type: 'label',
                    title: 'Meio',
                    trClass: 'text-center',
                })

                columns.push({
                    type: 'label',
                    title: 'Pendências',
                    trClass: 'text-center',
                })

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

        trash(entry) {
            confirm('Deseja realmente DELETAR este lançamento?', this).then(
                value => {
                    value && this.$store.dispatch('entries/delete', entry)
                },
            )
        },

        verify(entry) {
            confirm(
                'Confirma a marcação deste lançamento como "VERIFICADO"?',
                this,
            ).then(value => {
                value && this.$store.dispatch('entries/verify', entry)
            })
        },

        unverify(entry) {
            confirm(
                'O status de "VERIFICADO" será removido deste lançamento, confirma?',
                this,
            ).then(value => {
                value && this.$store.dispatch('entries/unverify', entry)
            })
        },

        analyse(entry) {
            confirm('Este lançamento foi ANALISADO?', this).then(value => {
                value && this.$store.dispatch('entries/analyse', entry)
            })
        },

        unanalyse(entry) {
            confirm(
                'Deseja remover o status "ANALISADO" deste lançamento?',
                this,
            ).then(value => {
                value && this.$store.dispatch('entries/unanalyse', entry)
            })
        },

        publish(entry) {
            confirm('Publicar este lançamento??', this).then(value => {
                value && this.$store.dispatch('entries/publish', entry)
            })
        },

        unpublish(entry) {
            confirm('Despublicar este lançamento?', this).then(value => {
                value && this.$store.dispatch('entries/unpublish', entry)
            })
        },

        createEntry() {
            if (filled(this.form.id)) {
                this.clearForm()
            }

            this.showModal = true
        },

        editEntry(entry) {
            this.showModal = true
        },
    },

    computed: {
        ...mapGetters({
            congressmanBudgetsSummaryLabel:
                'congressmanBudgets/currentSummaryLabel',
        }),
    },
}
</script>
