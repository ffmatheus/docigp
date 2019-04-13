const state = {
    loaded: false,
}

const getters = {
    can: state => permission => {
        return Store.getters['environment/getAbilities']
            ? Store.getters['environment/getAbilities'].includes(permission)
            : !!Store.state.environment.user
    },
}

const actions = {}

const mutations = {}

export default {
    state,
    getters,
    actions,
    mutations,
    namespaced: true,
}
