<template>

    <div class="grid lg:grid-cols-7 md:grid-cols-4 sm:grid-cols-2 shadow-xl">
        <div class="col-start-2">
            <settingsNav class=""></settingsNav>
        </div>
    </div>

    <div class="mx-auto content-center mt-10 mb-20">
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
const apiUrl = import.meta.env.VITE_API_BASE_URL
export default {
    name: 'user',
    setup() {
        // Instances of the router and store
        const router = useRouter();
        const store = useStore();
        return { router, store };
    },
    data() {
        return {
            // The name of the user
            name: '',
            // The headers we will send to the api
            headers: {
                Accept: 'application/json',
                'content-type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        };
    },
    methods: {},
    beforeMount() {
        // Checks the store if the user is authenticated
        const auth = computed(() => store.state.auth);
        // If not we will redirect to the login page
        if (!auth) {
            this.$router.push("/login");
            return;
        }
        // If the user is authenticated but the id is not correct we will redirect to the home page, (Add to redirect to user page)
        else if (this.store.state.id != this.$route.params.id) {
            this.$router.push("/");
            return;
        }
        // This function will make a request to the api to get the users name
        const userRequest = async () => {
            const response = await axios.get(apiUrl + '/api/user', { headers: this.headers, withCredentials: true });
            this.name = response.data["name"];
        };
        userRequest();
    },
    components: {codePage, accountPage, settingsNav }
}

</script>