import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('advisorContacts', ['clearForm']),
    },

    computed: {
        ...mapState({
            advisorContacts: state => state.advisorContacts,
        }),
    },
}
