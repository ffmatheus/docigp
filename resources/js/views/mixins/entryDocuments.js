import { mapState } from 'vuex'

export default {
    computed: {
        ...mapState({
            entryDocuments: state => state.entryDocuments,
        }),
    },
}
