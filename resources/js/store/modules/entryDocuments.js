import Form from '../../classes/Form'

import * as mutationsMixin from './mixins/mutations.js'
import * as actionsMixin from './mixins/actions.js'
import * as statesMixin from './mixins/states.js'
import * as gettersMixin from './mixins/getters.js'

const __emptyModel = {
    id: null,
    name: null,
    description: null,
}

let state = merge_objects(
    {
        selectedRole: __emptyModel,

        form: new Form(clone(__emptyModel)),

        emptyForm: clone(__emptyModel),

        mode: null,

        model: {
            name: 'entryDocument',

            table: 'entry_documents',

            class: { singular: 'EntryDocument', plural: 'EntryDocuments' },
        },
    },

    statesMixin.common,
)

let actions = merge_objects(actionsMixin, {
    selectEntryDocument(context, payload) {
        context.dispatch('entryDocuments/select', payload, { root: true })
    },

    publish(context, payload) {
        post(makeDataUrl(context) + '/' + payload.id + '/publish')
    },

    unpublish(context, payload) {
        post(makeDataUrl(context) + '/' + payload.id + '/unpublish')
    },

    comply(context, payload) {
        post(makeDataUrl(context) + '/' + payload.id + '/comply')
    },

    uncomply(context, payload) {
        post(makeDataUrl(context) + '/' + payload.id + '/uncomply')
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
