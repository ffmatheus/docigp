import { mapState } from 'vuex'

const appName = 'vue-parties'
import editMixin from '../pages/mixins/edit'

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
