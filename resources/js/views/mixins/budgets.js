import { mapState } from 'vuex'

export default {
    computed: {
        ...mapState({
            budgets: state => state.budgets,
        }),
    },
}
