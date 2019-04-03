import { mapState } from 'vuex'

export default {
    computed: {
        ...mapState({
            congressmen: state => state.congressmen,
        }),
    },
}
