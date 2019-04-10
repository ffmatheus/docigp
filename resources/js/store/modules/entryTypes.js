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

const __emptyForm = new Form(__emptyModel)

let state = merge_objects(
    {
        selectedRole: __emptyModel,

        form: clone(__emptyForm),

        emptyModel: clone(__emptyModel),

        mode: null,

        model: {
            name: 'entryType',

            table: 'entry_types',

            class: { singular: 'EntryType', plural: 'EntryTypes' },
        },

        service: {
            name: 'entry-types',

            uri: 'entry-types',
        },
    },

    statesMixin.common,
)

let actions = merge_objects(actionsMixin, {})
let mutations = mutationsMixin
let getters = gettersMixin

export default {
    state,
    actions,
    mutations,
    getters,
    namespaced: true,
}
