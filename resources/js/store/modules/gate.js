const state = {
    loaded: false,
}

const getters = {
    can: state => permission => {
        return Store.getters['environment/getPermissions']
            ? Store.getters['environment/getPermissions'].includes(permission)
            : false
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
