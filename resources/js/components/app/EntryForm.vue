<template>
    <div>
        <b-modal v-model="show" :title="formTitle">
            <b-form>
                <div class="row">
                    <div class="col-6">
                        <app-input
                            name="date"
                            label="Data"
                            v-model="form.fields.date"
                            :required="true"
                            :form="form"
                            v-mask="'##/##/####'"
                            :focus="true"
                        ></app-input>
                    </div>

                    <div class="col-6">
                        <app-input
                            name="value"
                            type="money"
                            label="Valor pago"
                            v-model="form.fields.value_abs"
                            :required="true"
                            :form="form"
                        ></app-input>
                    </div>
                </div>

                <app-input
                    name="object"
                    label="Objeto"
                    v-model="form.fields.object"
                    :required="true"
                    :form="form"
                ></app-input>

                <app-input
                    name="cpf_cnpj"
                    label="CPF / CNPJ"
                    v-model="form.fields.provider_cpf_cnpj"
                    :required="true"
                    :form="form"
                    v-mask="['###.###.###-##', '##.###.###/####-##']"
                    @input="onCpfCnpjChange($event)"
                    :bottomMessage="cpfCnpjMessage"
                    :bottomMessageType="cpfCnpj.is_valid ? '' : 'error'"
                ></app-input>

                <app-input
                    v-if="form.fields.provider_name"
                    name="provider_name"
                    label="Nome da pessoa ou razão social"
                    v-model="form.fields.provider_name"
                    :form="form"
                    :readonly="true"
                ></app-input>

                <app-input
                    v-if="!form.fields.provider_name"
                    name="to"
                    label="Nome da pessoa ou razão social"
                    v-model="form.fields.to"
                    :required="true"
                    :form="form"
                ></app-input>

                <app-select
                    name="cost_center_id"
                    label="Centro de custo"
                    v-model="form.fields.cost_center_id"
                    :required="true"
                    :form="form"
                    :options="getCostCenterRows()"
                ></app-select>
            </b-form>

            <template slot="modal-footer">
                <button @click="save()" class="btn btn-outline-gray btn-sm">
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
import { mapState } from 'vuex'
import crud from '../../views/mixins/crud'
import entries from '../../views/mixins/entries'

const service = {
    name: 'entries',

    uri:
        'congressmen/{congressmen.selected.id}/budgets/{congressmanBudgets.selected.id}/entries',
}

export default {
    mixins: [crud, entries],

    props: ['show'],

    data() {
        return {
            costCenters: Store.state.costCenters,

            service: service,

            checkCpfCnpj: _.debounce(cpfCnpj => {
                this.checkCpfCnpjChecker(cpfCnpj)
            }, 650),

            cpfCnpj: {
                person: null,
                is_valid: false,
                type: false,
                formatted: false,
                unformatted: '',
            },
        }
    },

    methods: {
        close() {
            this.showModal = false
        },

        save() {},

        onBoot() {
            this.$store.dispatch('costCenters/load')
        },

        getCostCenterRows() {
            return this.costCenters.data && this.costCenters.data.rows
                ? this.costCenters.data.rows
                : []
        },

        onCpfCnpjChange(cpfCnpj) {
            this.checkCpfCnpj(cpfCnpj)
        },

        checkCpfCnpjChecker(cpfCnpj) {
            post('/api/v1/cpf-cnpj/check', {
                cpf_cnpj: cpfCnpj,
            }).then(response => {
                this.cpfCnpj = response.data
            })
        },
    },

    computed: {
        formTitle() {
            return (this.form.fields.id ? 'Editar' : 'Novo') + ' lançamento'
        },

        showModal: {
            get() {
                return this.show
            },

            set(showModal) {
                this.$emit('update:show', showModal)
            },
        },

        cpfCnpjMessage() {
            if (blank(this.cpfCnpj.unformatted)) {
                return ''
            }

            if (!this.cpfCnpj.is_valid) {
                return 'Número inválido'
            }

            if (this.cpfCnpj.person && blank(this.form.fields.to)) {
                this.$store.commit('entries/mutateSetFormField', {
                    field: 'to',
                    value: this.cpfCnpj.person.name,
                })
            }

            return (
                (this.cpfCnpj.person ? this.cpfCnpj.person.name + ' - ' : '') +
                this.cpfCnpj.type.toLowerCase() +
                ': ' +
                this.cpfCnpj.formatted
            )
        },
    },
}
</script>
