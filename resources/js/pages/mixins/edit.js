export default {
    data() {
        return {
            mode: Store.state.environment.form.mode,
        }
    },

    methods: {
        editButton() {
            this.mode = 'edit'
        },

        cancel() {
            location.reload()
        },

        submitForm(action, formId) {
            let form = document.getElementById(formId)

            form.action = action

            form.submit()
        },
    },

    computed: {
        isShowing() {
            return this.mode === 'show'
        },

        isEditing() {
            return this.mode === 'edit'
        },

        isCreating() {
            return this.mode === 'create'
        },
    },
}
