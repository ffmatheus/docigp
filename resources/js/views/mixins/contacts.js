import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('contacts', ['clearForm']),
    },

    computed: {
        ...mapState({
            contacts: state => state.contacts,
        }),
    },
}
