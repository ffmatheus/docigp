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
// import { Modal } from 'bootstrap-vue/es/components'
// import { Button } from 'bootstrap-vue/es/components'
// import { Collapse } from 'bootstrap-vue/es/components'
// import { Form } from 'bootstrap-vue/es/components'
// import { FormGroup } from 'bootstrap-vue/es/components'
// import { FormInput } from 'bootstrap-vue/es/components'
// Vue.use(Modal)
// Vue.use(Button)
// Vue.use(Collapse)
// Vue.use(Form)
// Vue.use(FormGroup)
// Vue.use(FormInput)

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue)

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

/**
 * Vue The Mask
 */
Vue.use(() => import('vue-the-mask'))
