<template>
    <div class="table-responsive">
        <table
            class="table table-sm table-hover table-borderless table-striped card-body mb-0"
        >
            <thead>
                <tr>
                    <slot name="thead"></slot>
                    <th
                        v-if="columns"
                        v-for="column in columns"
                        :class="is_object(column) ? column.trClass : ''"
                    >
                        <span v-if="!is_object(column)">
                            {{ column }}
                        </span>
                        <span
                            v-if="isComponent(column, 'label')"
                            v-html="column.title"
                        >
                        </span>
                        <span v-if="isComponent(column, 'checkbox')">
                            <input
                                @change="
                                    $emit('input-checkbox-' + column.id, $event)
                                "
                                type="checkbox"
                                :id="column.id"
                            />
                        </span>
                    </th>
                </tr>
            </thead>

            <tbody>
                <slot></slot>
            </tbody>
        </table>

        <app-pagination
            v-if="pagination"
            :pagination="pagination"
            @goto-page="$emit('goto-page', $event)"
        ></app-pagination>
    </div>
</template>

<script>
export default {
    props: ['pagination', 'columns', 'rows'],

    methods: {
        is_object(target) {
            return is_object(target)
        },

        isComponent(component, componentName) {
            return (
                component.hasOwnProperty('type') &&
                component.type == componentName
            )
        },
    },
}
</script>
