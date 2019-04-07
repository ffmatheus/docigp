/**
 * Imports
 */
import Vue from 'vue'
import Vuex from 'vuex'

/**
 * Vuex
 */
Vue.use(Vuex)

/**
 * Global state
 */
import * as actions from './actions'
import * as getters from './getters'
import * as mutations from './mutations'

/**
 * Modules
 */
import admin from './modules/admin'
import environment from './modules/environment'
import congressmen from './modules/congressmen'
import budgets from './modules/budgets'
import congressmanBudgets from './modules/congressmanBudgets'
import entries from './modules/entries'
import entryDocuments from './modules/entryDocuments'
import costCenters from './modules/costCenters'

/**
 * State
 */
const state = {
    mounted: false,
}

/**
 * Store
 */
let store = new Vuex.Store({
    state,
    actions,
    getters,
    mutations,
    modules: {
        admin,
        environment,
        congressmen,
        budgets,
        congressmanBudgets,
        entries,
        entryDocuments,
        costCenters,
    },
})

store.dispatch('environment/boot')

window.Store = store
