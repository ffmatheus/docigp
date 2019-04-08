const state = {
    loaded: false,
}

const getters = {
    can: state => permission =>
        Store.getters['environment/getPermissions'].includes(permission),
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
