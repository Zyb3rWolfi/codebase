<template>
    <h1>Welcome {{ name }}</h1>
</template>
    
<script>
import axios from 'axios'
import { ref } from 'vue'
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import { computed } from 'vue';

export default {
    name: 'user',
    setup() {
        const router = useRouter()
        const store = useStore()
        return { router, store }
    },
    data() {
        return {
            name: '',
            headers: {
                Accept: 'application/json',
                'content-type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'}
        }
    },
    methods: {
    },
    beforeMount() {

        const auth = computed(() => store.state.auth)

        if (!auth) {
            this.$router.push("/login")
            return
        } else if (this.store.state.id != this.$route.params.id) {
            this.$router.push("/")
            return
        }

        const userRequest = async() => {
            const response = await axios.get('http://127.0.0.1:8000/api/user', {headers: this.headers, withCredentials: true})
            this.name = response.data["name"]
        }
        userRequest()
    }
}

</script>