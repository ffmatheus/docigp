<template>
    <div>
        <vue-dropzone
            ref="myVueDropzone"
            id="dropzone"
            :options="dropzoneOptions"
        ></vue-dropzone>
    </div>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
    props: ['value', 'url'],

    components: {
        vueDropzone: vue2Dropzone,
    },

    data() {
        return {
            dropzoneOptions: {
                url: this.url,
                thumbnailWidth: 150,
                maxFilesize: 0.5,
                headers: { 'My-Awesome-Header': 'header value' },
            },
        }
    },
}
</script>
