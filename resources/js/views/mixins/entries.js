import { mapState } from 'vuex'

export default {
    computed: {
        ...mapState({
            entries: state => state.entries,
        }),
    },
}
