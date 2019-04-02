import Vue from 'vue'

import VueRouter from 'vue-router'
Vue.use(VueRouter)

const Admin = () => import('./views/Admin')

let routes = [
    {
        path: '/',
        redirect: 'admin',
    },
    {
        path: '/admin',
        component: Admin,
    },
]

let router = new VueRouter({
    routes,
    linkActiveClass: 'active',
})

export default router
