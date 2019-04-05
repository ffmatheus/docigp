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
                'Pessoa Física / Jurídica',
                {
                    type: 'label',
                    title: 'Valor',
                    trClass: 'text-right',
                },
                {
                    type: 'label',
                    title: 'Tipo',
                    trClass: 'text-center',
                },
                {
                    type: 'label',
                    title: 'Verificado',
                    trClass: 'text-center',
                },
                {
                    type: 'label',
                    title: 'Aprovado',
                    trClass: 'text-center',
                },
                '',
            ]"
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

                <td class="align-middle">{{ entry.object }}</td>

                <td class="align-middle">{{ entry.to }}</td>

                <td class="align-middle text-right">
                    {{ entry.value_formatted }}
                </td>

                <td class="align-middle text-center">
                    <app-active-badge
                        :value="entry.value > 0"
                        :labels="['crédito', 'débito']"
                    ></app-active-badge>
                </td>

                <td class="align-middle text-center">
                    <app-active-badge
                        :value="entry.verified_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>

                <td class="align-middle text-center">
                    <app-active-badge
                        :value="entry.approved_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>

                <td class="align-middle text-right">
                    <button
                        v-if="!entry.verified_at"
                        class="btn btn-sm btn-micro btn-primary"
                        @click="verify(entry)"
                    >
                        marcar como verificado
                    </button>

                    <button
                        v-if="entry.verified_at"
                        class="btn btn-sm btn-micro btn-warning"
                        @click="unverify(entry)"
                    >
                        cancelar verificação
                    </button>

                    <button
                        v-if="entry.verified_at && !entry.approved_at"
                        class="btn btn-sm btn-micro btn-success"
                        @click="approve(entry)"
                    >
                        aprovar
                    </button>

                    <button
                        v-if="entry.verified_at && entry.approved_at"
                        class="btn btn-sm btn-micro btn-danger"
                        @click="unapprove(entry)"
                    >
                        cancelar aprovação
                    </button>
                </td>
            </tr>
        </app-table>
    </app-table-panel>
</template>

<script>
import crud from '../../views/mixins/crud'
import entries from '../../views/mixins/entries'
import permissions from '../../views/mixins/permissions'
import { mapActions } from 'vuex'

const service = {
    name: 'entries',

    uri:
        'congressmen/{congressmen.selected.id}/budgets/{congressmanBudgets.selected.id}/entries',
}

export default {
    mixins: [crud, entries, permissions],

    data() {
        return {
            service: service,
        }
    },

    methods: {
        ...mapActions(service.name, ['selectEntry']),

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

        approve(entry) {
            confirm('Confirma a APROVAÇÃO deste lançamento?', this).then(
                value => {
                    value && this.$store.dispatch('entries/approve', entry)
                },
            )
        },

        unapprove(entry) {
            confirm(
                'Confirma a remoção do status "APROVADO" deste lançamento?',
                this,
            ).then(value => {
                value && this.$store.dispatch('entries/unapprove', entry)
            })
        },
    },
}
</script>
