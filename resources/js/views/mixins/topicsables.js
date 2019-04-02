import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('topicsables', ['clearForm']),
    },

    computed: {
        ...mapState({
            people: state => state.people,

            topicsables: state => state.topicsables,
        }),
    },
}
