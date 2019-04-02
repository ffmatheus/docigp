import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('categories', ['clearForm']),
    },

    computed: {
        ...mapState({
            categories: state => state.categories,
        }),
    },
}
