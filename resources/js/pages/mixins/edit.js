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

        cancel(url) {
            if(Boolean(jQuery('#id').val())) { //Editing a register
                location.reload()
            } else { //Creating a register
                window.location.replace(url)
            }
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
