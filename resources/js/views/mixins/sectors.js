import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('sectors', ['clearForm']),
    },

    computed: {
        ...mapState({
            sectors: state => state.sectors,
        }),
    },
}
