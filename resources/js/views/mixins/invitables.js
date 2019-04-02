import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('invitables', ['clearForm']),
    },

    computed: {
        ...mapState({
            invitables: state => state.invitables,
        }),
    },
}
