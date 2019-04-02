<template>
    <app-table-panel
        :title="'Orçamento mensal (' + pagination.total + ')'"
        :per-page="perPage"
        :filter-text="filterText"
        @input-filter-text="filterText = $event.target.value"
        @set-per-page="perPage = $event"
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
                @click="select(budgets)"
                v-for="budgets in budgets.data.rows"
                :class="{
                    'cursor-pointer': true,
                    'bg-primary-lighter text-white': isCurrent(
                        budgets,
                        selected,
                    ),
                }"
            >
                <td>{{ budgets.year }} / {{ budgets.month }}</td>

                <td class="text-right">
                    {{ budgets.federal_value_formatted }}
                </td>

                <td class="text-right">
                    {{ budgets.percentage_formatted }}
                </td>

                <td class="text-right">
                    {{ budgets.value_formatted }}
                </td>
            </tr>
        </app-table>
    </app-table-panel>
</template>

<script>
import crud from '../../views/mixins/crud'
import budgets from '../../views/mixins/budgets'
import permissions from '../../views/mixins/permissions'

export default {
    mixins: [crud, budgets, permissions],

    data() {
        return {
            service: { name: 'budgets', uri: 'budgets' },
        }
    },

    methods: {},
}
</script>
