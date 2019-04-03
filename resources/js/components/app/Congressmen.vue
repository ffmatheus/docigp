<template>
    <app-table-panel
        :title="'Deputados (' + pagination.total + ')'"
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
            :columns="['Nome do Parlamentar']"
        >
            <tr
                @click="select(congressman)"
                v-for="congressman in congressmen.data.rows"
                :class="{
                    'cursor-pointer': true,
                    'bg-primary-lighter text-white': isCurrent(
                        congressman,
                        selected,
                    ),
                }"
            >
                <td class="align-middle">{{ congressman.name }}</td>
            </tr>
        </app-table>
    </app-table-panel>
</template>

<script>
import crud from '../../views/mixins/crud'
import congressmen from '../../views/mixins/congressmen'
import permissions from '../../views/mixins/permissions'

export default {
    mixins: [crud, congressmen, permissions],

    data() {
        return {
            service: { name: 'congressmen', uri: 'congressmen' },
        }
    },

    methods: {},
}
</script>
