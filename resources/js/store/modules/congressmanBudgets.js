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
            name: 'congressmanBudgets',

            table: 'congressman_budgets',

            class: {
                singular: 'CongressmanBudget',
                plural: 'CongressmanBudgets',
            },
        },
    },

    statesMixin.common,
)

let actions = merge_objects(actionsMixin, {
    selectCongressmanBudget(context, payload) {
        context.dispatch('congressmanBudgets/select', payload, { root: true })

        context.dispatch('entries/load', payload, { root: true })
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
