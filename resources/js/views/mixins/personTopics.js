import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('personTopics', ['clearForm']),
    },

    computed: {
        ...mapState({
            people: state => state.people,

            // personTopics: state => state.personTopics,

            topics: state => state.topics,
        }),
    },
}
