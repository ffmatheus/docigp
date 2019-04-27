
import { mapState } from 'vuex'
import editMixin from './mixins/edit'

const appName = 'vue-entry_types'

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
