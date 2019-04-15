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
    props: ['value', 'url', 'token'],

    components: {
        vueDropzone: vue2Dropzone,
    },

    data() {
        return {
            dropzoneOptions: {
                url: this.url,
                thumbnailWidth: 150,
                maxFilesize: 0.5,
                headers: { 'X-CSRF-TOKEN': this.token },
                error: function(e, t) {
                    e.previewElement.classList.add('dz-error'),
                        (t = t.errors.file[0])
                    for (
                        var i = 0,
                            n = (n = e.previewElement.querySelectorAll(
                                '[data-dz-errormessage]',
                            ));
                        ;

                    ) {
                        if (i >= n.length) break
                        n[i++].textContent = t
                    }
                },
            },
        }
    },
}
</script>
