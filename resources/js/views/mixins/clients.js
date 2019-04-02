import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('clients', ['clearForm']),
    },

    computed: {
        ...mapState({
            clients: state => state.clients,

            currentClient: state =>
                state.clients.data.rows ? state.clients.data.rows[0] : null,
        }),
    },
}
