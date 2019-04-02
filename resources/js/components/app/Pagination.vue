<template>
    <nav class="text-center card-footer" v-if="pagination.last_page > 1">
        <ul class="pagination justify-content-center mb-0">
            <li
                class="page-item"
                @click="$emit('goto-page', pagination.current_page - 1)"
            >
                <div class="page-link" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Anterior</span>
                </div>
            </li>

            <li
                :class="{
                    'page-item': true,
                    active: page === pagination.current_page,
                }"
                v-for="page in pagination.pages"
                @click="$emit('goto-page', page)"
            >
                <div class="page-link">
                    {{ page }}
                </div>
            </li>

            <li
                class="page-item"
                @click="$emit('goto-page', pagination.current_page + 1)"
            >
                <div class="page-link" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Próxima</span>
                </div>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: ['pagination'],
}
</script>
