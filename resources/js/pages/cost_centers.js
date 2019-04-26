import { mapState } from 'vuex'
import editMixin from './mixins/edit'

const appName = 'vue-cost_centers'

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
