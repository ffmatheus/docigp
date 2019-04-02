export default {
    computed: {
        username: {
            get() {
                return this.form.fields.username
            },
            set(value) {
                this.mutateSetFormField({
                    field: 'username',
                    value,
                })
            },
        },

        fieldUsernameDefault() {
            return null
        },
    },
}
