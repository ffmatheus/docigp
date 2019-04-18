export default {
    data() {
        return {
            // mode: laravel.mode,
            mode: '',
        }
    },

    methods: {
        editButton() {
            console.log('editando')
            this.mode = 'edit'
        },

        cancel() {
            console.log('cancelando')
            location.reload()
        },

        submitForm(action, formId) {
            console.log('submitForm')

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
