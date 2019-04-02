import { mapState, mapActions } from 'vuex'

export default {
    data: () => {
        return {
            people_current: {
                id: 'null',
            },
        }
    },

    methods: {
        ...mapActions('people', ['clearForm']),

        makePhotoUrl(photoUrl = null) {
            if (!photoUrl) {
                photoUrl = this.people.form.fields.photoUrl
            }

            if (!photoUrl) {
                photoUrl = this.people.selected.photoUrl
            }

            let otherPeopleSelected =
                this.people_current.id != this.people.selected.id
            this.people_current.id = this.people.selected.id

            return flush_image_cache(photoUrl, otherPeopleSelected)
        },
    },

    computed: {
        ...mapState({
            people: state => state.people,

            personInstitutions: state => state.personInstitutions,

            contacts: state => state.contacts,

            addresses: state => state.addresses,

            personCategories: state => state.personCategories,

            personTopics: state => state.personTopics,

            advisors: state => state.advisors,

            advisorContacts: state => state.advisorContacts,
        }),
    },
}
