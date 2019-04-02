import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('institutions', ['clearForm']),
    },

    computed: {
        ...mapState({
            institutions: state => state.institutions,
        }),
    },
}
