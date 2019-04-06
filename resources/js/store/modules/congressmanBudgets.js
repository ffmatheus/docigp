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
            name: 'congressmanBudget',

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

        context.dispatch('congressmen/load', payload, { root: true })

        context.commit(
            'entries/mutateSetSelected',
            { id: null },
            { root: true },
        )

        context.commit(
            'entriesDocuments/mutateSetSelected',
            { id: null },
            { root: true },
        )
    },

    changePercentage(context, payload) {
        post(makeDataUrl(context) + '/' + payload.congressmanBudget.id, {
            percentage: payload.percentage,
        })
    },

    comply(context, payload) {
        post(makeDataUrl(context) + '/' + payload.id + '/comply')
    },

    uncomply(context, payload) {
        post(makeDataUrl(context) + '/' + payload.id + '/uncomply')
    },

    publish(context, payload) {
        post(makeDataUrl(context) + '/' + payload.id + '/publish')
    },

    unpublish(context, payload) {
        post(makeDataUrl(context) + '/' + payload.id + '/unpublish')
    },

    deposit(context, payload) {
        post(makeDataUrl(context) + '/' + payload.id + '/deposit')
    },
})

let mutations = mutationsMixin

let getters = merge_objects(gettersMixin, {
    currentSummaryLabel(state, getters) {
        return (
            format_year_date(state.selected) +
            ' - ' +
            state.selected.value_formatted
        )
    },
})

export default {
    state,
    actions,
    mutations,
    getters,
    namespaced: true,
}
