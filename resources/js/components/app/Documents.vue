<template>
    <app-table-panel
        :title="'Documentos (' + pagination.total + ')'"
        titleCollapsed="Documento"
        :per-page="perPage"
        :filter-text="filterText"
        @input-filter-text="filterText = $event.target.value"
        @set-per-page="perPage = $event"
        :collapsedLabel="selected.name"
        :is-selected="selected.id !== null"
    >
        <template slot="buttons">
            <button
                class="btn btn-primary btn-sm pull-right"
                @click="createEntry()"
                title="Novo documento"
            >
                <i class="fa fa-plus"></i>
            </button>
        </template>

        <app-table
            :pagination="pagination"
            @goto-page="gotoPage($event)"
            :columns="[
                'Name',
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
                @click="selectEntryDocument(document)"
                v-for="document in entryDocuments.data.rows"
                :class="{
                    'cursor-pointer': true,
                    'bg-primary-lighter text-white': isCurrent(
                        document,
                        selected,
                    ),
                }"
            >
                <td class="align-middle">
                    {{ document.name.substring(1, 10) }}
                </td>

                <td class="align-middle text-center">
                    <app-active-badge
                        :value="document.approved_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>

                <td class="align-middle text-center">
                    <app-active-badge
                        :value="document.published_at"
                        :labels="['sim', 'não']"
                    ></app-active-badge>
                </td>

                <td class="align-middle text-right">
                    <button
                        v-if="!document.approved_at"
                        class="btn btn-sm btn-micro btn-primary"
                        @click="approve(document)"
                    >
                        <i class="fa fa-check"></i> aprovar
                    </button>

                    <button
                        v-if="document.approved_at"
                        class="btn btn-sm btn-micro btn-primary"
                        @click="unapprove(document)"
                    >
                        <i class="fa fa-check"></i> desaprovar
                    </button>

                    <button
                        v-if="document.approved_at && !document.published_at"
                        class="btn btn-sm btn-micro btn-danger"
                        @click="publish(document)"
                    >
                        <i class="fa fa-check"></i> publicar
                    </button>

                    <button
                        v-if="document.published_at"
                        class="btn btn-sm btn-micro btn-danger"
                        @click="publish(document)"
                    >
                        <i class="fa fa-check"></i> despublicar
                    </button>

                    <a
                        href="/img/docigp.pdf"
                        target="_blank"
                        class="btn btn-sm btn-micro btn-warning cursor-pointer"
                    >
                        <i class="fa fa-file-image"></i>
                    </a>

                    <button
                        v-if="!document.approved_at"
                        class="btn btn-sm btn-micro btn-danger"
                        @click="trash(document)"
                        title="deletar documento"
                    >
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        </app-table>
    </app-table-panel>
</template>

<script>
import crud from '../../views/mixins/crud'
import permissions from '../../views/mixins/permissions'
import entryDocuments from '../../views/mixins/entryDocuments'
import { mapActions } from 'vuex'

const service = {
    name: 'entryDocuments',

    uri:
        'congressmen/{congressmen.selected.id}/budgets/{congressmanBudgets.selected.id}/entries/{entries.selected.id}/documents',
}

export default {
    mixins: [crud, entryDocuments, permissions],

    data() {
        return {
            service: service,
        }
    },

    methods: {
        ...mapActions(service.name, ['selectEntryDocument']),

        trash(document) {},

        approve(document) {
            confirm('Confirma a APROVAÇÃO deste documento?', this).then(
                value => {
                    value &&
                        this.$store.dispatch('entryDocuments/approve', document)
                },
            )
        },

        unapprove(document) {
            confirm(
                'Confirma a remoção do status "APROVADO" deste documento?',
                this,
            ).then(value => {
                value &&
                    this.$store.dispatch('entryDocuments/unapprove', document)
            })
        },

        publish(document) {
            confirm('Confirma a PUBLICAÇÃO deste documento?', this).then(
                value => {
                    value &&
                        this.$store.dispatch('entryDocuments/publish', document)
                },
            )
        },

        unpublish(document) {
            confirm('Confirma a DESPUBLICAÇÃO deste documento?', this)
                .then(this)
                .then(value => {
                    value &&
                        this.$store.dispatch(
                            'entryDocuments/unpublish',
                            document,
                        )
                })
        },
    },
}
</script>
