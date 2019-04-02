import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('costumes', ['clearForm']),
    },

    computed: {
        ...mapState({
            costumes: state => state.costumes,
        }),
    },
}
