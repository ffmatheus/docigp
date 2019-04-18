const appName = 'vue-providers'
import editMixin from '../pages/mixins/edit'
//import helpersMixin from '../pages/mixins/helpers'

if (jQuery("#" + appName).length > 0) {
    new Vue({
        el: '#'+appName,

        //mixins: [editMixin, helpersMixin],
        mixins: [editMixin],

        data: {
        },

        computed: {
            mask: function () {
            },
        },

        methods: {
            refresh() {
            }
        },

        beforeMount() {
        },

        mounted() {
        }
    })
}
