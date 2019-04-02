import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('advisors', ['clearForm']),
    },

    computed: {
        ...mapState({
            advisors: state => state.advisors,
        }),
    },
}
