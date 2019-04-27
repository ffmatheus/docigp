import { mapState } from 'vuex'

const appName = 'vue-cost_centers'
import editMixin from '../pages/mixins/edit'

if (jQuery('#' + appName).length > 0) {
    new Vue({
        el: '#' + appName,

        mixins: [editMixin],
    })
}
