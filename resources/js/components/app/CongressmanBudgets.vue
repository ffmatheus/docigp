<template>
    <app-table-panel
        :title="'Orçamento mensal (' + pagination.total + ')'"
        titleCollapsed="Orçamento de"
        :per-page="perPage"
        :filter-text="filterText"
        @input-filter-text="filterText = $event.target.value"
        @set-per-page="perPage = $event"
        :collapsedLabel="makeDate(selected)"
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
                    title: 'Máximo',
                    trClass: 'text-right',
                },
            ]"
        >
            <tr
                @click="select(budget)"
                v-for="budget in congressmanBudgets.data.rows"
                :class="{
                    'cursor-pointer': true,
                    'bg-primary-lighter text-white': isCurrent(
                        budget,
                        selected,
                    ),
                }"
            >
                <td class="align-middle">{{ makeDate(budget) }}</td>

                <td class="align-middle text-right">
                    {{ budget.state_value_formatted }}
                </td>

                <td class="align-middle text-right">
                    {{ budget.percentage_formatted }}
                </td>

                <td class="align-middle text-right">
                    {{ budget.value_formatted }}
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
        makeDate(budget) {
            return budget.year + ' / ' + budget.month
        },
    },
}
</script>
