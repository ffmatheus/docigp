import * as gettersMixin from './mixins/getters.js'

const __emptyTable = {
    filter: {
        text: null,
    },

    links: {
        pagination: {
            per_page: null,

            current_page: null,
        },
    },

    rows: {},
}

const state = {
    loaded: false,
    tables: {
        contact_types: __emptyTable,
        institutions: __emptyTable,
        roles: __emptyTable,
        people: __emptyTable,
        costumes: __emptyTable,
        sectors: __emptyTable,
        sub_events: __emptyTable,
        addresses: __emptyTable,
    },
}

let getters = merge_objects(gettersMixin, {
    getPermissions(state, getters) {
        return state.user.permissions_array
    },

    getCurrentClient(state, getters) {
        return state.session.current_client
    },
})

const actions = {
    load(context) {
        return get('/api/v1/environment').then(response => {
            context.commit('mutateSetData', response.data)
        })
    },

    loadContactTypes(context) {
        return get('/api/v1/contact-types', {
            params: { query: context.getters.getFullQueryFilter },
        }).then(response => {
            context.commit('mutateSetContactTypes', response.data)
        })
    },

    loadInstitutions(context) {
        return get('/api/v1/institutions', {
            params: { query: context.getters.getFullQueryFilter },
        }).then(response => {
            context.commit('mutateSetInstitutions', response.data)
        })
    },

    loadRoles(context) {
        return get('/api/v1/roles', {
            params: { query: context.getters.getFullQueryFilter },
        }).then(response => {
            context.commit('mutateSetRoles', response.data)
        })
    },

    loadCategories(context) {
        return get('/api/v1/categories', {
            params: { query: context.getters.getFullQueryFilter },
        }).then(response => {
            context.commit('mutateSetCategories', response.data)
        })
    },

    loadTopics(context) {
        return get('/api/v1/topics', {
            params: { query: context.getters.getFullQueryFilter },
        }).then(response => {
            context.commit('mutateSetTopics', response.data)
        })
    },

    loadPeople(context) {
        return get('/api/v1/people', {
            params: { query: context.getters.getFullQueryFilter },
        }).then(response => {
            context.commit('mutateSetPeople', response.data)
        })
    },

    loadCostumes(context) {
        return get('/api/v1/costumes', {
            params: { query: context.getters.getFullQueryFilter },
        }).then(response => {
            context.commit('mutateSetCostumes', response.data)
        })
    },

    loadSectors(context) {
        return get('/api/v1/sectors', {
            params: { query: context.getters.getFullQueryFilter },
        }).then(response => {
            context.commit('mutateSetSectors', response.data)
        })
    },

    loadSubEvents(context) {
        return get('/api/v1/sub-events', {
            params: { query: context.getters.getFullQueryFilter },
        }).then(response => {
            context.commit('mutateSetSubEvents', response.data)
        })
    },

    loadAddresses(context) {
        return get('/api/v1/addresses', {
            params: { query: context.getters.getFullQueryFilter },
        }).then(response => {
            context.commit('mutateSetAddresses', response.data)
        })
    },

    loadAvailableAddresses(context) {
        return get('/api/v1/addresses/availableAddresses', {
            params: { query: context.getters.getFullQueryFilter },
        }).then(response => {
            context.commit('mutateSetAvailableAddresses', response.data)
        })
    },

    boot(context) {
        context.commit('mutateSetData', window.laravel)

        context.dispatch('load')

        if (context.state.user != null) {
            context.dispatch('loadContactTypes')
            context.dispatch('loadInstitutions')
            context.dispatch('loadRoles')
            context.dispatch('loadCategories')
            context.dispatch('loadTopics')
            context.dispatch('loadPeople')
            context.dispatch('loadCostumes')
            context.dispatch('loadSectors')
            context.dispatch('loadSubEvents')
            context.dispatch('loadAvailableAddresses')
        }

        context.dispatch('subscribeToChannels')
    },

    subscribeToChannels(context) {
        subscribePublicChannel(
            'addresses',
            '.App\\Events\\AddressesChanged',
            () => {
                context.dispatch('loadAvailableAddresses')
            },
        )
    },
}

const mutations = {
    mutateSetData(state, payload) {
        state['loaded'] = false

        _.forIn(payload, (val, key) => {
            state[key] = val
        })

        state['loaded'] = true
    },

    mutateSetContactTypes(state, payload) {
        state['tables']['contact_types'] = payload
    },

    mutateSetInstitutions(state, payload) {
        state['tables']['institutions'] = payload
    },

    mutateSetRoles(state, payload) {
        state['tables']['roles'] = payload
    },

    mutateSetCategories(state, payload) {
        state['tables']['categories'] = payload
    },
    mutateSetTopics(state, payload) {
        state['tables']['topics'] = payload
    },

    mutateSetPeople(state, payload) {
        state['tables']['people'] = payload
    },

    mutateSetCostumes(state, payload) {
        state['tables']['costumes'] = payload
    },

    mutateSetSectors(state, payload) {
        state['tables']['sectors'] = payload
    },

    mutateSetAddresses(state, payload) {
        state['tables']['addresses'] = payload
    },

    mutateSetAvailableAddresses(state, payload) {
        state['tables']['availableAddresses'] = payload
    },

    mutateSetSubEvents(state, payload) {
        let subEvents = _.map(clone(payload.rows), subEvent => {
            subEvent.name =
                subEvent.name +
                (subEvent.sector ? ' - ' + subEvent.sector.name : '') +
                (subEvent.place ? ' - ' + subEvent.place : '')

            return subEvent
        })

        payload.rows = subEvents

        state['tables']['sub_events'] = payload
    },
}

export default {
    state,
    getters,
    actions,
    mutations,
    namespaced: true,
}
