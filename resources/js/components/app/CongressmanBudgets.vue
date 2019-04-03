<template>
    <app-table-panel
        :title="'Orçamento mensal (' + pagination.total + ')'"
        titleCollapsed="Orçamento de"
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
                'Mês/Ano',
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
                    title: 'Pendências',
                    trClass: 'text-center',
                },
                {
                    type: 'label',
                    title: 'Aprovado',
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
                @click="select(congressmanBudget)"
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

                <td class="align-middle text-center">
                    <app-active-badge
                        :value="!congressmanBudget.has_pendency"
                        :labels="['não', 'sim']"
                    ></app-active-badge>
                </td>

                <td class="align-middle text-center">
                    <app-active-badge
                        :value="congressmanBudget.approved_at"
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
                        @click="editPercentage(congressmanBudget)"
                        class="btn btn-sm btn-micro btn-primary"
                        title="Editar percentual"
                    >
                        %
                    </button>

                    <button
                        v-if="!congressmanBudget.has_pendency"
                        class="btn btn-sm btn-micro btn-warning"
                    >
                        aprovar
                    </button>

                    <button
                        v-if="congressmanBudget.approved_at"
                        class="btn btn-sm btn-micro btn-danger"
                    >
                        publicar
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

export default {
    mixins: [crud, congressmanBudgets, permissions],

    data() {
        return {
            service: {
                name: 'congressmanBudgets',
                uri: 'congressmen/{congressmen.selected.id}/budgets',
            },
        }
    },

    methods: {
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
    },
}
</script>
