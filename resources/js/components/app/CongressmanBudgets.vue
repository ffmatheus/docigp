<template>
    <app-table-panel
        :title="'Orçamento mensal (' + pagination.total + ')'"
        titleCollapsed="Orçamento"
        :per-page="perPage"
        :filter-text="filterText"
        @input-filter-text="filterText = $event.target.value"
        @set-per-page="perPage = $event"
        :collapsedLabel="makeDate(selected) + ' - ' + selected.value_formatted"
        :is-selected="selected.id !== null"
    >
        <app-table
            :pagination="pagination"
            @goto-page="gotoPage($event)"
            :columns="[
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
                {
                    type: 'label',
                    title: 'Pendências',
                    trClass: 'text-center',
                },
                {
                    type: 'label',
                    title: 'Conforme',
                    trClass: 'text-center',
                },
                {
                    type: 'label',
                    title: 'Publicado',
                    trClass: 'text-center',
                },
                '',
            ]"
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

                <td class="align-middle text-center">
                    <app-active-badge
                        :value="!congressmanBudget.has_pendency"
                        :labels="['não', 'sim']"
                    ></app-active-badge>
                </td>

                <td class="align-middle text-center">
                    <app-active-badge
                        :value="congressmanBudget.complied_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>

                <td class="align-middle text-center">
                    <app-active-badge
                        :value="congressmanBudget.published_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>

                <td class="align-middle text-right">
                    <button
                        v-if="congressmanBudget.entries_count === 0"
                        @click="editPercentage(congressmanBudget)"
                        class="btn btn-sm btn-micro btn-primary"
                        title="Alterar percentual solicitado"
                    >
                        <i class="fa fa-edit"></i> percentual
                    </button>

                    <button
                        v-if="
                            !congressmanBudget.has_pendency &&
                                !congressmanBudget.complied_at
                        "
                        class="btn btn-sm btn-micro btn-warning"
                        title="Marcar orçamento como 'em conformidade'"
                        @click="comply(congressmanBudget)"
                    >
                        <i class="fa fa-check"></i> conforme
                    </button>

                    <button
                        v-if="congressmanBudget.complied_at"
                        class="btn btn-sm btn-micro btn-warning"
                        title="Cancelar marcação de 'em conformidade'"
                        @click="uncomply(congressmanBudget)"
                    >
                        <i class="fa fa-ban"></i> conformidade
                    </button>

                    <button
                        v-if="congressmanBudget.published_at"
                        class="btn btn-sm btn-micro btn-danger"
                        title="Remover do Portal da Transparência"
                        @click="unpublish(congressmanBudget)"
                    >
                        <i class="fa fa-ban"></i> despublicar
                    </button>

                    <button
                        v-if="congressmanBudget.complied_at"
                        class="btn btn-sm btn-micro btn-danger"
                        title="Publicar no Portal da Transparência"
                        @click="publish(congressmanBudget)"
                    >
                        <i class="fa fa-check"></i> publicar
                    </button>
                </td>
            </tr>
        </app-table>
    </app-table-panel>
</template>

<script>
import crud from '../../views/mixins/crud'
import congressmanBudgets from '../../views/mixins/congressmanBudgets'
import permissions from '../../views/mixins/permissions'
import { mapActions } from 'vuex'

const service = {
    name: 'congressmanBudgets',
    uri: 'congressmen/{congressmen.selected.id}/budgets',
}

export default {
    mixins: [crud, congressmanBudgets, permissions],

    data() {
        return {
            service: service,
        }
    },

    methods: {
        ...mapActions(service.name, ['selectCongressmanBudget']),

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

        comply(entry) {
            confirm('Este orçamento mensal está "EM CONFORMIDADE"?', this).then(
                value => {
                    value &&
                        this.$store.dispatch('congressmanBudgets/comply', entry)
                },
            )
        },

        uncomply(entry) {
            confirm(
                'Confirma a remoção do status "EM CONFORMIDADE" deste lançamento?',
                this,
            ).then(value => {
                value &&
                    this.$store.dispatch('congressmanBudgets/uncomply', entry)
            })
        },
    },
}
</script>
