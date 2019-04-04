<template>
    <app-table-panel
        :title="'Lançamentos (' + pagination.total + ')'"
        titleCollapsed="Deputado / Deputada"
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
                'Data',
                'Objeto',
                'Creditado a',
                'Valor',
                {
                    type: 'label',
                    title: 'Verificado',
                    trClass: 'text-center',
                },
                {
                    type: 'label',
                    title: 'Autorizado',
                    trClass: 'text-center',
                },
                {
                    type: 'label',
                    title: 'Publicado',
                    trClass: 'text-center',
                },
            ]"
        >
            <tr
                @click="select(entries)"
                v-for="entries in entries.data.rows"
                :class="{
                    'cursor-pointer': true,
                    'bg-primary-lighter text-white': isCurrent(
                        entries,
                        selected,
                    ),
                }"
            >
                <td class="align-middle">{{ entries.date_formatted }}</td>

                <td class="align-middle">{{ entries.object }}</td>

                <td class="align-middle">{{ entries.to }}</td>

                <td class="align-middle">{{ entries.value_formatted }}</td>

                <td class="align-middle text-center">
                    <app-active-badge
                        :value="entries.verified_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>

                <td class="align-middle text-center">
                    <app-active-badge
                        :value="entries.authorized_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>

                <td class="align-middle text-center">
                    <app-active-badge
                        :value="entries.published_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>
            </tr>
        </app-table>
    </app-table-panel>
</template>

<script>
import crud from '../../views/mixins/crud'
import entries from '../../views/mixins/entries'
import permissions from '../../views/mixins/permissions'

export default {
    mixins: [crud, entries, permissions],

    data() {
        return {
            service: {
                name: 'entries',

                uri:
                    'congressmen/{congressmen.selected.id}/budgets/{congressmanBudgets.selected.id}/entries',
            },
        }
    },
}
</script>
