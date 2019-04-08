import Form from '../../classes/Form'

import * as mutationsMixin from './mixins/mutations.js'
import * as actionsMixin from './mixins/actions.js'
import * as statesMixin from './mixins/states.js'
import * as gettersMixin from './mixins/getters.js'

const __emptyModel = {
    id: null,
    date: null,
    value: null,
    value_abs: null,
    object: null,
    cpf_cnpj: null,
    to: null,
    provider_id: null,
    provider_name: null,
    provider_cpf_cnpj: null,
    cost_center_id: null,
}

let state = merge_objects(
    {
        selectedRole: __emptyModel,

        form: new Form(clone(__emptyModel)),

        emptyForm: clone(__emptyModel),

        mode: null,

        model: {
            name: 'entry',

            table: 'entries',

            class: { singular: 'Entry', plural: 'Entries' },
        },
    },

    statesMixin.common,
)

let actions = merge_objects(actionsMixin, {
    selectEntry(context, payload) {
        context.dispatch('entries/select', payload, { root: true })

        context.dispatch('entryDocuments/load', payload, { root: true })

        context.commit('mutateFormData', payload)
    },

    verify(context, payload) {
        post(makeDataUrl(context) + '/' + payload.id + '/verify')
    },

    unverify(context, payload) {
        post(makeDataUrl(context) + '/' + payload.id + '/unverify')
    },

    analyse(context, payload) {
        post(makeDataUrl(context) + '/' + payload.id + '/analyse')
    },

    unanalyse(context, payload) {
        post(makeDataUrl(context) + '/' + payload.id + '/unanalyse')
    },

    delete(context, payload) {
        post(makeDataUrl(context) + '/' + payload.id + '/delete')
    },
})

let mutations = mutationsMixin
let getters = gettersMixin

export default {
    state,
    actions,
    mutations,
    getters,
    namespaced: true,
}
