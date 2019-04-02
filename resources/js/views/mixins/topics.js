import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('topics', ['clearForm']),
    },

    computed: {
        ...mapState({
            topics: state => state.topics,
        }),
    },
}
