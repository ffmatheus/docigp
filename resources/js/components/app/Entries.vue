<template>
    <app-table-panel
        :title="'Lançamentos (' + pagination.total + ')'"
        titleCollapsed="Lançamento"
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
        <template slot="buttons">
            <button
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
            :columns="[
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
                {
                    type: 'label',
                    title: 'Tipo',
                    trClass: 'text-center',
                },
                {
                    type: 'label',
                    title: 'Pendências',
                    trClass: 'text-center',
                },
                {
                    type: 'label',
                    title: 'Verificado',
                    trClass: 'text-center',
                },
                {
                    type: 'label',
                    title: 'Conforme',
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

                <td class="align-middle">
                    {{ entry.object }}<br />
                    <span>
                        <small class="text-primary">
                            {{ entry.cost_center_code }} -
                            {{ entry.cost_center_name_formatted }}
                        </small>
                    </span>
                </td>

                <td class="align-middle">{{ makeRecipientName(entry) }}</td>

                <td class="align-middle text-right">
                    {{ entry.documents_count }}
                </td>

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
                        :value="!entry.has_pendency"
                        :labels="['não', 'sim']"
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
                        :value="entry.complied_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>

                <td class="align-middle text-right">
                    <button
                        v-if="!entry.verified_at"
                        class="btn btn-sm btn-micro btn-primary"
                        @click="verify(entry)"
                        title="Marcar como verificado"
                    >
                        <i class="fa fa-check"></i> verificar
                    </button>

                    <button
                        v-if="entry.verified_at"
                        class="btn btn-sm btn-micro btn-warning"
                        @click="unverify(entry)"
                        title="Cancelar verificação"
                    >
                        <i class="fa fa-ban"></i> verificação
                    </button>

                    <button
                        v-if="entry.verified_at && !entry.complied_at"
                        class="btn btn-sm btn-micro btn-success"
                        @click="comply(entry)"
                        title="Marcar como 'em conformidade'"
                    >
                        <i class="fa fa-check"></i> conforme
                    </button>

                    <button
                        v-if="entry.verified_at && entry.complied_at"
                        class="btn btn-sm btn-micro btn-danger"
                        @click="uncomply(entry)"
                        title="Cancelar marcação de 'em conformidade'"
                    >
                        <i class="fa fa-ban"></i> conformidade
                    </button>

                    <button
                        class="btn btn-sm btn-micro btn-danger"
                        @click="trash(entry)"
                        title="deletar lançamento"
                        :disabled="entry.complied_at"
                    >
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        </app-table>
    </app-table-panel>
</template>

<script>
import { mapActions } from 'vuex'
import crud from '../../views/mixins/crud'
import entries from '../../views/mixins/entries'
import permissions from '../../views/mixins/permissions'
import congressmanBudgets from '../../views/mixins/congressmanBudgets'

const service = {
    name: 'entries',

    uri:
        'congressmen/{congressmen.selected.id}/budgets/{congressmanBudgets.selected.id}/entries',
}

export default {
    mixins: [crud, entries, permissions, congressmanBudgets],

    data() {
        return {
            service: service,
        }
    },

    methods: {
        ...mapActions(service.name, ['selectEntry']),

        trash(entry) {},

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

        comply(entry) {
            confirm('Este lançamento está "EM CONFORMIDADE"?', this).then(
                value => {
                    value && this.$store.dispatch('entries/comply', entry)
                },
            )
        },

        uncomply(entry) {
            confirm(
                'Confirma a remoção do status "EM CONFORMIDADE" deste lançamento?',
                this,
            ).then(value => {
                value && this.$store.dispatch('entries/uncomply', entry)
            })
        },

        makeRecipientName(entry) {
            if (!entry.provider_id) {
                return entry.to
            }

            return (
                entry.provider_name +
                ' (' +
                entry.provider_type +
                ': ' +
                entry.provider_cpf_cnpj +
                ')'
            )
        },
    },
}
</script>
