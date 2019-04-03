/**
 * Vue & Vuex
 */
window.Vue = require('vue')
window.Vuex = require('vuex')

/**
 * Vue The Mask
 */
Vue.use(() => import('vue-the-mask'))

/**
 * SweetAlert
 */
Vue.use(() => import('vue-swal'))

/**
 * Vue Bootstrap
 */
import { Modal } from 'bootstrap-vue/es/components'
import { Button } from 'bootstrap-vue/es/components'
import { Collapse } from 'bootstrap-vue/es/components'
Vue.use(Modal)
Vue.use(Button)
Vue.use(Collapse)

/**
 * Autoload Vue components
 */
const file = require.context('../components/app/', true, /\.vue$/i)
file.keys().map(file => {
    const name = 'App' + _.last(file.split('/')).split('.')[0]

    return Vue.component(name, () =>
        import('../components/app/' + basename(file)),
    )
})

/**
 * VueSelect
 */
Vue.component('vue-select', () => import('vue-select'))
