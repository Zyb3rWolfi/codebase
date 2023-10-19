<template>
    <div class="grid grid-cols-1 row-auto ">
        <div class="flex-auto flex flex-col col-start-1">
            <settingsNav class=""></settingsNav>
        </div>
    </div>

    <div class=" ml-72 mt-10">
        <router-view></router-view>
    </div>

</template>
    
<script>
import axios from 'axios'
import { ref } from 'vue'
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import { computed } from 'vue';
import codePage from '../components/code.vue';
import accountPage from '../components/account.vue';
import settingsNav from '../components/settingsNav.vue'

export default {
    name: 'user',
    setup() {
        const router = useRouter();
        const store = useStore();
        return { router, store };
    },
    data() {
        return {
            name: '',
            headers: {
                Accept: 'application/json',
                'content-type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        };
    },
    methods: {},
    beforeMount() {
        const auth = computed(() => store.state.auth);
        if (!auth) {
            this.$router.push("/login");
            return;
        }
        else if (this.store.state.id != this.$route.params.id) {
            this.$router.push("/");
            return;
        }
        const userRequest = async () => {
            const response = await axios.get('http://127.0.0.1:8000/api/user', { headers: this.headers, withCredentials: true });
            this.name = response.data["name"];
        };
        userRequest();
    },
    components: {codePage, accountPage, settingsNav }
}

</script>