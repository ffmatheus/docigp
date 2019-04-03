export default {
    data: () => {
        return {
            loading: {
                environment: false,

                table: false,
            },
        }
    },

    computed: {
        filterText: {
            get() {
                return this.$store.state[this.service.name].data.filter.text
            },

            set(payload) {
                return this.$store.dispatch(
                    this.service.name + '/mutateSetQueryFilterText',
                    payload,
                )
            },
        },

        emptyForm() {
            return this.$store.state[this.service.name].emptyForm
        },

        form() {
            return this.$store.state[this.service.name].form
        },

        selected() {
            return this.$store.state[this.service.name].selected
        },

        environment() {
            return this.$store.state['environment']
        },

        pagination() {
            return this.$store.state[this.service.name].data.links
                ? this.$store.state[this.service.name].data.links.pagination
                : {}
        },

        perPage: {
            get() {
                return this.pagination.per_page
            },

            set(value) {
                this.$store.dispatch(this.service.name + '/setPerPage', value)
            },
        },
    },

    methods: {
        load() {
            this.$store.commit(
                this.service.name + '/mutateSetPerPage',
                this.environment.user.per_page,
            )

            return this.$store.dispatch(this.service.name + '/load')
        },

        select(model) {
            return this.$store.dispatch(this.service.name + '/select', model)
        },

        save(mode) {
            return this.$store.dispatch(this.service.name + '/save', mode)
        },

        mutateSetErrors(errors) {
            this.$store.commit(this.service.name + '/mutateSetErrors', errors)
        },

        mutateFormData(data) {
            this.$store.commit(this.service.name + '/mutateFormData', data)
        },

        mutateSetFormField(data) {
            this.$store.commit(this.service.name + '/mutateSetFormField', data)
        },

        mutateSetService(data) {
            this.$store.commit(this.service.name + '/mutateSetService', data)
        },

        isLoading() {
            return this.loading.environment || this.loading.table
        },

        boot() {
            dd(this.service)
            this.mutateSetService(this.service)

            if (
                !this.service.hasOwnProperty('performLoad') ||
                this.service.performLoad
            ) {
                this.load().then(() => {
                    this.fillFormWhenEditing()
                })
            } else {
                this.fillFormWhenEditing()
            }

            this.$store.dispatch(this.service.name + '/subscribeToTableEvents')
        },

        fillFormWhenEditing() {
            const model =
                this.mode === 'update'
                    ? _.find(this.rows, model => {
                          return model.id === this.$route.params.id
                      })
                    : this.form
                    ? clone(this.emptyForm)
                    : {}

            this.mutateFormData(model)

            this.mutateSetErrors({})

            this.fillAdditionalFormFields()
        },

        fillAdditionalFormFields() {},

        back() {
            this.$router.back()
        },

        saveModel() {
            this.save(this.mode)
                .then(() => {
                    this.back()

                    this.clearForm()
                })
                .catch(response => {
                    dd('catch response', response)
                })
        },

        gotoPage(page, namespace = null, pagination = null) {
            pagination = pagination ? pagination : this.pagination

            if (pagination.current_page === page) {
                return
            }

            if (page < 1) {
                return
            }

            if (page > pagination.last_page) {
                return
            }

            this.$store.dispatch(
                (namespace ? namespace : this.service.name) + '/setCurrentPage',
                page,
            )
        },

        isCurrent(model, selected) {
            return model.id === selected.id
        },

        setPerPage() {
            this.$store.commit(
                this.service.name + '/mutateSetPerPage',
                this.environment.user.per_page,
            )
        },

        getDataUrl() {
            return buildApiUrl(this.service.uri, this.$store.state)
        },

        getStoreUrl() {
            return buildApiUrl(this.service.uri, this.$store.state)
        },

        getUpdateStoreUrl() {
            return buildApiUrl(this.service.uri, this.$store.state)
        },

        getColor(color, position) {
            return get_color(color, position)
        },
    },

    mounted() {
        this.boot()
    },
}
