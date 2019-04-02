import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('institutions', ['clearForm']),
    },

    computed: {
        ...mapState({
            phoneBook: state => state.phoneBook,
        }),
    },
}
