<template>
    <div v-if="!auth">
    <div>
        <Login />
    </div>
    </div> 
</template>

<script>
import { computed, onUpdated } from 'vue';
import { useStore } from 'vuex';
import Login from '../views/Login.vue';
import Register from '../views/SignUp.vue';

export default {
    setup() {
        const store = useStore()
        return {store}
    },
    computed: {
        auth() {
            console.log(this.$store.state.auth)
            return this.$store.state.auth
        }
    },
    components: {
        Login,
        Register,
    },
}

</script>