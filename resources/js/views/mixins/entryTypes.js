import { mapState } from 'vuex'

export default {
    computed: {
        ...mapState({
            entryTypes: state => state.entryTypes,
        }),
    },
}
