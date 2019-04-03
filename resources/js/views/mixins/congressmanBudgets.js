import { mapState } from 'vuex'

export default {
    computed: {
        ...mapState({
            congressmanBudgets: state => state.congressmanBudgets,
        }),
    },
}
