<template>
    <div class="card shadow-sm mb-4 mt-4">
        <div class="align-items-end card-header">
            <div class="row border-bottom">
                <div class="col-12">
                    <div class="p-2 mb-2">
                        <h4 class="mb-0">{{ title }}</h4>
                    </div>
                </div>
            </div>

            <div v-if="perPage" class="row">
                <div class="col-12 card-filters bg-filters py-2">
                    <div class="row">
                        <div v-if="perPage" class="col-4">
                            <input
                                class="form-control"
                                :value="filterText"
                                @input="$emit('input-filter-text', $event)"
                                placeholder="filtrar"
                            />
                        </div>

                        <div v-if="perPage" class="col-2 p-0">
                            <app-per-page
                                :value="perPage"
                                @input="$emit('set-per-page', $event)"
                            ></app-per-page>
                        </div>

                        <div class="col-6 text-right">
                            <slot name="buttons"></slot>

                            <router-link
                                v-if="addButton"
                                :to="addButton.uri"
                                tag="button"
                                class="btn btn-primary pull-right"
                                :disabled="addButton.disabled"
                                :dusk="addButton.dusk"
                            >
                                <i class="fa fa-plus"></i>
                            </router-link>
                        </div>

                        <div class="col-12" v-if="hasCheckboxes()">
                            <div
                                :class="
                                    'p-2 mb-2 mt-2 bg-gray-light' +
                                        (dontCenterFilters
                                            ? ''
                                            : ' text-center')
                                "
                            >
                                <slot name="checkboxes"></slot>
                            </div>
                        </div>

                        <div class="col-12" v-if="hasSelects()">
                            <div class="p-12 mb-2 mt-2">
                                <slot name="selects"></slot>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12"><slot></slot></div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'title',
        'add-button',
        'add-button-disabled',
        'columns',
        'filter-text',
        'per-page',
        'dont-center-filters',
    ],

    methods: {
        hasSelects() {
            return this.hasSlot('selects')
        },

        hasCheckboxes() {
            return this.hasSlot('checkboxes')
        },

        hasSlot(name) {
            return !!this.$slots[name] || !!this.$scopedSlots[name]
        },
    },
}
</script>
