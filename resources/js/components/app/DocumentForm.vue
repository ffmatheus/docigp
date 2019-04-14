<template>
    <div>
        <b-modal v-model="show" title="Novo documento" @shown="onShow()">
            <template>
                <app-dropzone url="/api/v1/upload-files"></app-dropzone>
            </template>

            <template slot="modal-footer">
                <button
                    @click="saveAndClose()"
                    class="btn btn-outline-gray btn-sm"
                >
                    <i v-if="busy" class="fas fa-compact-disc fa-spin"></i>

                    Gravar
                </button>

                <button @click="close()" class="btn btn-success btn-sm">
                    Cancelar
                </button>
            </template>
        </b-modal>
    </div>
</template>

<script>
import crud from '../../views/mixins/crud'
import entries from '../../views/mixins/entries'

const service = {
    name: 'entryDocuments',

    uri:
        'congressmen/{congressmen.selected.id}/budgets/{congressmanBudgets.selected.id}/entries/{entries.selected.id}/documents',
}

export default {
    mixins: [crud, entries],

    props: ['show'],

    data() {
        return {
            busy: false,

            service: service,
        }
    },

    methods: {
        close() {
            this.showModal = false
        },

        saveAndClose() {
            this.busy = true

            this.saveModel(() => {
                this.closeModal(true)
            })
        },

        closeModal() {
            this.showModal = false
        },

        onShow() {
            this.busy = false
        },
    },

    computed: {
        showModal: {
            get() {
                return this.show
            },

            set(showModal) {
                this.$emit('update:show', showModal)
            },
        },
    },
}
</script>
