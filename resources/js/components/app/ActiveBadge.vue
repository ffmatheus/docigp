<template>
    <div>
        <span v-if="value" class="badge badge-success"> {{ labels[0] }} </span>

        <span v-if="!value" class="badge badge-danger"> {{ labels[1] }} </span>
    </div>
</template>

<script>
export default {
    props: ['value', 'labels'],
}
</script>
