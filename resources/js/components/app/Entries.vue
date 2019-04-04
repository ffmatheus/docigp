<template>
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="text-center">Prestação de Contas</h1>
        </div>

        <div class="col-sm-12 col-md-5">
            <app-congressmen></app-congressmen>
        </div>

        <div class="col-sm-12 col-md-7">
            <app-congressman-budgets
                v-if="congressmen.selected.id"
            ></app-congressman-budgets>
        </div>

        <div class="col-sm-12">
            <app-budget-entries
                v-if="congressmanBudgets.selected.id"
            ></app-budget-entries>
        </div>
    </div>
</template>

<script>
import congressmen from '../../views/mixins/congressmen'
import congressmanBudgets from '../../views/mixins/congressmanBudgets'

export default {
    mixins: [congressmen, congressmanBudgets],
}
</script>
