<template>
    <div class="input-group">
        <select
            v-bind:value="value"
            v-on:input="$emit('input', $event.target.value)"
            class="custom-select"
        >
            <option value="5" selected>5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="250">250</option>
        </select>
    </div>
</template>

<script>
export default {
    props: ['value'],
}
</script>
