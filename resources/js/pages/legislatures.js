import { mapState } from 'vuex'
import editMixin from './mixins/edit'

const appName = 'vue-legislatures'

if (jQuery('#' + appName).length > 0) {
    new Vue({
        el: '#' + appName,

        mixins: [editMixin],

        computed: {
            ...mapState({
                environment: state => window.Store.state.environment,
            }),
        },
    })
}
