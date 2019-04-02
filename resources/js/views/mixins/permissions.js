export default {
    methods: {
        can() {
            return can.apply(this, arguments)
        },

        cannot() {
            return !this.can.apply(this, arguments)
        },
    },
}
