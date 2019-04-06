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
        <template slot="checkboxes">
            <div class="row">
                <div class="col">
                    <app-input
                        name="havingMandate"
                        label="com mandato"
                        type="checkbox"
                        v-model="havingMandate"
                        :required="true"
                        :form="form"
                        inline="true"
                    ></app-input>
                </div>
            </div>
        </template>

        <app-table
            :pagination="pagination"
            @goto-page="gotoPage($event)"
            :columns="[
                'Nome do Parlamentar',
                {
                    type: 'label',
                    title: 'Pendências',
                    trClass: 'text-center',
                },
                {
                    type: 'label',
                    title: 'Situação',
                    trClass: 'text-center',
                },
            ]"
        >
            <tr
                @click="selectCongressman(congressman)"
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

                <td class="align-middle text-center">
                    <app-active-badge
                        :value="!congressman.has_pendency"
                        :labels="['não', 'sim']"
                    ></app-active-badge>
                </td>

                <td class="align-middle text-center">
                    <app-active-badge
                        :value="congressman.has_mandate"
                        :labels="['com mandato', 'sem mandato ']"
                    ></app-active-badge>
                </td>
            </tr>
        </app-table>
    </app-table-panel>
</template>

<script>
import crud from '../../views/mixins/crud'
import congressmen from '../../views/mixins/congressmen'
import permissions from '../../views/mixins/permissions'
import { mapActions } from 'vuex'

const service = { name: 'congressmen', uri: 'congressmen' }

export default {
    mixins: [crud, congressmen, permissions],

    data() {
        return {
            service: { name: 'congressmen', uri: 'congressmen' },
        }
    },

    methods: {
        ...mapActions(service.name, ['selectCongressman']),
    },

    computed: {
        havingMandate: {
            get() {
                return this.$store.state['congressmen'].data.filter.checkboxes
                    .havingMandate
            },

            set(filter) {
                this.$store.commit('congressmen/mutateFilterCheckbox', {
                    field: 'havingMandate',
                    value: filter,
                })

                this.$store.dispatch('congressmen/load')
            },
        },
    },
}
</script>
