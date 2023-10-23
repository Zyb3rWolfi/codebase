<template>
    <div class="md:container mx-auto flex-col my-24 flex justify-center items-center">
        <form class=" col-start start-3 p-16 rounded-2xl shadow-xl" style="background-color: #23272f;">
            
            <p id="loginTitle" class=" text-center text-2xl font-bold mb-5">Sign In</p>
            
            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                <input v-model="login.email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                <input v-model="login.password" type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <p v-if="incorrect" class=" text-red-600 text-sm mb-5">Incorrect Password Or Username</p>
            <div class="flex align-middle justify-center">
                <button @click="submitData()" type="button" class=" text-white hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center border-2 dark:hover:bg-gray-500 dark:focus:ring-blue-800">Submit</button>
            </div>
            <div class="flex align-middle justify-center">
                <a @click="signUp()" class="cursor-pointer text-sm text-gray-400 mt-5">Dont have an account? Sign up.</a>
            </div>

        </form>
    </div>

</template>
    
<script>
import { ref } from 'vue'
import axios from 'axios'
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import NavBar from '../components/navbar.vue';

export default {
    name: 'search',
    setup() {
        
        const router = useRouter()
        const store = useStore()
        return { router, store }

    },
    components: {
        NavBar
    },
    data() {
        return {
            login: {
                email: '',
                password: '',
            },
            incorrect: false,
            headers: {
                Accept: 'application/json',
                'content-type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'}
        }
    },
    methods: {
        async submitData() {
            try {
                if(this.login.email == '' || this.login.password == '') {
                    return;
                }
                const response = await axios.post('http://127.0.0.1:8000/api/login', this.login, {headers: this.headers, withCredentials: true})
                console.log(response.data)
                if (response.status == 401) {
                    return this.incorrect = true
                }
                const user = await axios.get('http://127.0.0.1:8000/api/user', {headers: this.headers, withCredentials: true})
                await this.$store.dispatch('setAuthentication', true)
                await this.$store.dispatch('setUserID', user.data["id"])
                await this.$router.push("/user/" + user.data["id"] + "/code")

            } catch(e) {
                this.incorrect = true
                console.log(e)
            }

        },
        async signUp() {
            await this.$router.push("/register")
        }
    }
    }
    
</script>
