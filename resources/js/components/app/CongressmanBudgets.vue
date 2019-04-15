<template>
    <app-table-panel
        :title="'Orçamento mensal (' + pagination.total + ')'"
        titleCollapsed="Orçamento"
        :subTitle="congressmen.selected.name"
        :per-page="perPage"
        :filter-text="filterText"
        @input-filter-text="filterText = $event.target.value"
        @set-per-page="perPage = $event"
        :collapsedLabel="currentSummaryLabel"
        :is-selected="selected.id !== null"
    >
        <app-table
            :pagination="pagination"
            @goto-page="gotoPage($event)"
            :columns="getTableColumns()"
        >
            <tr
                @click="selectCongressmanBudget(congressmanBudget)"
                v-for="congressmanBudget in congressmanBudgets.data.rows"
                :class="{
                    'cursor-pointer': true,
                    'bg-primary-lighter text-white': isCurrent(
                        congressmanBudget,
                        selected,
                    ),
                }"
            >
                <td class="align-middle">{{ makeDate(congressmanBudget) }}</td>

                <td class="align-middle text-right">
                    {{ congressmanBudget.state_value_formatted }}
                </td>

                <td class="align-middle text-right">
                    {{ congressmanBudget.percentage_formatted }}
                </td>

                <td class="align-middle text-right">
                    {{ congressmanBudget.value_formatted }}
                </td>

                <td class="align-middle text-right">
                    {{ congressmanBudget.entries_count }}
                </td>

                <td
                    v-if="can('congressman-budgets:show')"
                    class="align-middle text-center"
                >
                    <app-active-badge
                        :value="!congressmanBudget.has_pendency"
                        :labels="['não', 'sim']"
                    ></app-active-badge>
                </td>

                <td
                    v-if="can('congressman-budgets:show')"
                    class="align-middle text-center"
                >
                    <app-active-badge
                        :value="congressmanBudget.analysed_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>

                <td
                    v-if="can('congressman-budgets:show')"
                    class="align-middle text-center"
                >
                    <app-active-badge
                        :value="congressmanBudget.published_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>

                <td
                    v-if="can('congressman-budgets:show')"
                    class="align-middle text-right"
                >
                    <button
                        v-if="
                            can('congressman-budgets:deposit') &&
                                !congressmanBudget.has_deposit &&
                                !congressmanBudget.analysed_at &&
                                !congressmanBudget.published_at
                        "
                        @click="deposit(congressmanBudget)"
                        class="btn btn-sm btn-micro btn-success"
                        :title="
                            'Depositar ' +
                                congressmanBudget.state_value_formatted +
                                ' na conta de '
                        "
                    >
                        <i class="fa fa-dollar-sign"></i> depositar
                    </button>

                    <button
                        v-if="
                            can('congressman-budgets:percentage') &&
                                !congressmanBudget.analysed_at &&
                                !congressmanBudget.has_deposit
                        "
                        @click="editPercentage(congressmanBudget)"
                        class="btn btn-sm btn-micro btn-primary"
                        title="Alterar percentual solicitado"
                    >
                        <i class="fa fa-edit"></i> percentual
                    </button>

                    <button
                        v-if="
                            can('congressman-budgets:analyse') &&
                                !congressmanBudget.has_pendency &&
                                !congressmanBudget.analysed_at
                        "
                        class="btn btn-sm btn-micro btn-warning"
                        title="Marcar orçamento como 'analisado'"
                        @click="analyse(congressmanBudget)"
                    >
                        <i class="fa fa-check"></i> analisado
                    </button>

                    <button
                        v-if="
                            can('congressman-budgets:analyse') &&
                                congressmanBudget.analysed_at
                        "
                        class="btn btn-sm btn-micro btn-warning"
                        title="Cancelar marcação de 'em analisado'"
                        @click="unanalyse(congressmanBudget)"
                    >
                        <i class="fa fa-ban"></i> analisado
                    </button>

                    <button
                        v-if="
                            can('congressman-budgets:publish') &&
                                congressmanBudget.analysed_at &&
                                !congressmanBudget.published_at
                        "
                        class="btn btn-sm btn-micro btn-danger"
                        title="Publicar no Portal da Transparência"
                        @click="publish(congressmanBudget)"
                    >
                        <i class="fa fa-check"></i> publicar
                    </button>

                    <button
                        v-if="
                            can('congressman-budgets:publish') &&
                                congressmanBudget.published_at
                        "
                        class="btn btn-sm btn-micro btn-danger"
                        title="Remover do Portal da Transparência"
                        @click="unpublish(congressmanBudget)"
                    >
                        <i class="fa fa-ban"></i> despublicar
                    </button>
                </td>
            </tr>
        </app-table>
    </app-table-panel>
</template>

<script>
import crud from '../../views/mixins/crud'
import { mapActions, mapGetters } from 'vuex'
import congressmen from '../../views/mixins/congressmen'
import permissions from '../../views/mixins/permissions'
import congressmanBudgets from '../../views/mixins/congressmanBudgets'

const service = {
    name: 'congressmanBudgets',
    uri: 'congressmen/{congressmen.selected.id}/budgets',
}

export default {
    mixins: [crud, congressmen, congressmanBudgets, permissions],

    data() {
        return {
            service: service,
        }
    },

    methods: {
        ...mapActions(service.name, ['selectCongressmanBudget']),

        getTableColumns() {
            let columns = [
                'Ano / Mês',

                {
                    type: 'label',
                    title: 'Referência',
                    trClass: 'text-right',
                },
                {
                    type: 'label',
                    title: '%',
                    trClass: 'text-right',
                },
                {
                    type: 'label',
                    title: 'Solicitado',
                    trClass: 'text-right',
                },
                {
                    type: 'label',
                    title: 'Lançamentos',
                    trClass: 'text-right',
                },
            ]

            if (can('congressman-budgets:show')) {
                columns.push({
                    type: 'label',
                    title: 'Pendências',
                    trClass: 'text-center',
                })

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

                columns.push('')
            }

            return columns
        },

        makeDate(congressmanBudget) {
            return congressmanBudget.year + ' / ' + congressmanBudget.month
        },

        changePercentage: function(congressmanBudget, value) {
            return this.$store.dispatch('congressmanBudgets/changePercentage', {
                congressmanBudget: congressmanBudget,
                percentage: value,
            })
        },

        editPercentage(congressmanBudget) {
            return input('Novo percentual', this).then(value => {
                if (!value) {
                    return
                }

                if (
                    !is_number(value) ||
                    to_number(value) < 0 ||
                    to_number(value) > 100
                ) {
                    return show_message(
                        'Você precisa digitar um número entre 0 e 100',
                        this,
                        'error',
                    )
                }

                return this.changePercentage(congressmanBudget, value)
            })
        },

        analyse(congressmanBudget) {
            confirm('Este orçamento mensal está "EM CONFORMIDADE"?', this).then(
                value => {
                    value &&
                        this.$store.dispatch(
                            'congressmanBudgets/analyse',
                            congressmanBudget,
                        )
                },
            )
        },

        unanalyse(congressmanBudget) {
            confirm(
                'Deseja remover o status "EM CONFORMIDADE" deste lançamento?',
                this,
            ).then(value => {
                value &&
                    this.$store.dispatch(
                        'congressmanBudgets/unanalyse',
                        congressmanBudget,
                    )
            })
        },

        publish(congressmanBudget) {
            confirm('Confirma a PUBLICAÇÃO deste orçamento mensal?', this).then(
                value => {
                    value &&
                        this.$store.dispatch(
                            'congressmanBudgets/publish',
                            congressmanBudget,
                        )
                },
            )
        },

        unpublish(congressmanBudget) {
            confirm(
                'Confirma a DESPUBLICAÇÃO deste orçamento mensal?',
                this,
            ).then(value => {
                value &&
                    this.$store.dispatch(
                        'congressmanBudgets/unpublish',
                        congressmanBudget,
                    )
            })
        },

        deposit(congressmanBudget) {
            confirm(
                'Confirma o depósito de ' +
                    congressmanBudget.value_formatted +
                    ' na conta de ' +
                    this.congressmen.selected.name +
                    '?',
                this,
            ).then(value => {
                value &&
                    this.$store.dispatch(
                        'congressmanBudgets/deposit',
                        congressmanBudget,
                    )
            })
        },
    },

    computed: {
        ...mapGetters(service.name, ['currentSummaryLabel']),
    },
}
</script>
