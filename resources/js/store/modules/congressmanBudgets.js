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
    subscribeToModelEvents(context, payload) {
        context.dispatch('leaveModelChannel', payload)

        context.dispatch('entries/leaveModelChannel', payload, {
            root: true,
        })

        if (context.state.model) {
            subscribePublicChannel(
                context.state.model.table + '.' + payload.id,
                '.App\\Events\\' + 'EntriesChanged',
                event => {
                    console.log(event)

                    console.log(
                        'Received event and need to update entries table',
                    )

                    context.dispatch('entries/load', payload, {
                        root: true,
                    })
                },
            )
        }
    },

    selectCongressmanBudget(context, payload) {
        if (
            !context.state.selected ||
            context.state.selected.id != payload.id
        ) {
            context.dispatch('entries/setCurrentPage', 1, { root: true })

            context.commit(
                'entries/mutateSetSelected',
                { id: null },
                { root: true },
            )

            context.commit(
                'entryDocuments/mutateSetSelected',
                { id: null },
                { root: true },
            )

            context.commit(
                'entryComments/mutateSetSelected',
                { id: null },
                { root: true },
            )

            context.dispatch('congressmen/markAsRead', payload, { root: true })
        }

        context.dispatch('congressmanBudgets/select', payload, { root: true })
    },

    changePercentage(context, payload) {
        post(makeDataUrl(context) + '/' + payload.congressmanBudget.id, {
            percentage: payload.percentage,
        })
    },

    close(context, payload) {
        post(makeDataUrl(context) + '/' + payload.id + '/close')
    },

    reopen(context, payload) {
        post(makeDataUrl(context) + '/' + payload.id + '/reopen')
    },

    analyse(context, payload) {
        post(makeDataUrl(context) + '/' + payload.id + '/analyse')
    },

    unanalyse(context, payload) {
        post(makeDataUrl(context) + '/' + payload.id + '/unanalyse')
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

    selectedClosedAt(state, getters) {
        return state.selected.closed_at
    },
})

export default {
    state,
    actions,
    mutations,
    getters,
    namespaced: true,
}
