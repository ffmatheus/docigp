const state = {
    loaded: false,
}

const getters = {
    can: state => ability => {
        return Store.getters['environment/getAbilities']
            ? Store.getters['environment/getAbilities'].includes(ability) ||
                  Store.getters['environment/getAbilities'].includes('*')
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
