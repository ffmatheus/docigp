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
            name: 'congressman',

            table: 'congressmen',

            class: { singular: 'Congressman', plural: 'Congressmen' },
        },
    },

    statesMixin.common,
)

let actions = merge_objects(actionsMixin, {
    selectCongressman(context, payload) {
        context.dispatch('congressmen/select', payload, { root: true })

        context.dispatch('congressmanBudgets/load', payload, { root: true })
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
