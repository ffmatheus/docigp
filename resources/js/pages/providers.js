import { mapState } from 'vuex'
import editMixin from '../pages/mixins/edit'
const appName = 'vue-providers'

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
