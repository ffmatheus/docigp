<template>
    <div>
        <div class="py-2 text-center">
            <h2><i class="fas fa-cogs"></i> Painel de Controle</h2>
        </div>

        <div class="row" v-if="can('receptive')">
            <div class="col-12"></div>
        </div>

        <div>
            <div class="col-12">
                <div class="container">
                    <div class="card-deck mb-3 text-center"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import crud from './mixins/crud'
// import permissions from './mixins/permissions'
import { mapState, mapActions } from 'vuex'

export default {
    mixins: [crud, permissions],

    data() {
        return {
            service: { name: 'admin', uri: 'admin' },
        }
    },

    methods: {
        ...mapActions('admin', ['clearForm', 'clearErrors']),
    },

    computed: {
        ...mapState({
            admin: state => state.admin.data.rows,
        }),
    },

    mounted() {},
}
</script>

<style></style>
