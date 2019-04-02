import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('roles', ['clearForm']),
    },

    computed: {
        ...mapState({
            roles: state => state.roles,
        }),
    },
}
