import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('personInstitutions', ['clearForm']),
    },

    computed: {
        ...mapState({
            personInstitutions: state => state.personInstitutions,
        }),
    },
}
