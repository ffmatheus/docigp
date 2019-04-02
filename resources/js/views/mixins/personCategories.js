import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('personCategories', ['clearForm']),
    },

    computed: {
        ...mapState({
            people: state => state.people,

            personCategories: state => state.personCategories,
        }),
    },
}
