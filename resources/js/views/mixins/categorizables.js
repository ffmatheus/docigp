import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('categorizables', ['clearForm']),
    },

    computed: {
        ...mapState({
            people: state => state.people,

            categorizables: state => state.categorizables,
        }),
    },
}
