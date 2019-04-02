import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('contactTypes', ['clearForm']),
    },

    computed: {
        ...mapState({
            contactTypes: state => state.contactTypes,
        }),
    },
}
