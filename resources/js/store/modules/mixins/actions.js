let debouncedByUrl = {}

export function load(context) {
    const url = makeDataUrl(context)

    if (url) {
        let urlHash = hash(url + JSON.stringify(context.getters.getQueryFilter))

        if (typeof debouncedByUrl[urlHash] === 'undefined') {
            debouncedByUrl[urlHash] = _.debounce((targetUrl, targetContext) => {
                get(targetUrl, {
                    params: { query: targetContext.getters.getQueryFilter },
                }).then(response => {
                    context.dispatch('setDataAfterLoad', response.data)
                })
            }, 450)
        }

        return debouncedByUrl[urlHash](url, context)
    }
}

export function setDataAfterLoad(context, payload) {
    payload.filter.text = context.state.data.filter.text

    context.commit('mutateSetData', payload)
}

export function save(context, payload) {
    const url =
        payload === 'create'
            ? makeStoreUrl(context)
            : makeUpdateUrl(context) + '/' + context.state.form.fields.id

    return context.state.form.post(url, context.state.form.fields)
}

export function clearForm(context) {
    context.state.form.fields = clone(context.state.emptyForm)
    context.state.form.errors.clear()
}

export function mutateSetQueryFilterText(context, payload) {
    let data = context.state.data

    data.filter.text = payload

    data.links.pagination.current_page = 1

    context.commit('mutateSetData', data)

    loadDebounced(context)
}

export function setCurrentPage(context, payload) {
    let data = context.state.data

    data.links.pagination.current_page = payload

    context.commit('mutateSetData', data)

    loadDebounced(context)
}

export function setPerPage(context, payload) {
    context.commit('mutateSetPerPage', payload)

    context.dispatch('load')

    context.dispatch('updateUserPerPage', payload)
}

export function updateUserPerPage(context, payload) {
    post('/api/v1/users/per-page/' + payload)
}

export function select(context, payload) {
    context.dispatch('subscribeToModelEvents', payload)

    context.commit('mutateSetSelected', payload)

    context.commit('mutateFormData', payload)
}

export function mutateFilterCheckbox(context, payload) {
    context.commit('mutateFilterCheckbox', payload)

    loadDebounced(context)
}

export function mutateFilterSelect(context, payload) {
    context.commit('mutateFilterSelect', payload)

    loadDebounced(context)
}

export function subscribeToModelEvents(context, payload) {
    if (context.state.model) {
        subscribePublicChannel(
            context.state.model.name + '.' + payload.id,
            '.App\\Events\\' + context.state.model.class.singular + 'Updated',
            () => {
                loadDebounced(context)
            },
        )
    }

    context.dispatch('subscribeExtraChannels', payload)
}

export function subscribeToTableEvents(context) {
    if (context.state.model) {
        subscribePublicChannel(
            context.state.model.table,
            '.App\\Events\\' + context.state.model.class.plural + 'Changed',
            () => {
                loadDebounced(context)
            },
        )

        context.dispatch('subscribeExtraChannels')
    }
}

export function subscribeExtraChannels(context, payload = null) {}
