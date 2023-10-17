<template>
    <aside id="default-sidebar" c class="fixed top-0 left-0 border-r z-40 w-64 h-screen pt-20 transition-transform -translate-x-full border-gray-200 sm:translate-x-0 dark:border-gray-500" aria-label="Sidebar">
        <sidebarVue></sidebarVue>
    </aside>
    <div class="sm:ml-96 mt-20">
        <router-view></router-view>
    </div>

</template>
    
<script>
import axios from 'axios'
import { ref } from 'vue'
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import { computed } from 'vue';
import sidebarVue from '../components/sidebar.vue';
import codePage from '../components/code.vue';
import accountPage from '../components/account.vue';

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
    components: { sidebarVue, codePage, accountPage }
}

</script>