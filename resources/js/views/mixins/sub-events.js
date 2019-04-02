import { mapState, mapActions } from 'vuex'

export default {
    methods: {
        ...mapActions('subEvents', ['clearForm']),
    },

    computed: {
        ...mapState({
            addresses: state => state.addresses,

            events: state => state.events,

            subEvents: state => state.subEvents,
        }),
    },
}
