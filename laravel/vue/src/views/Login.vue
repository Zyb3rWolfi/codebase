<template>
    <div v-if="!auth && showModal" id="loginView" class=" md:container mx-auto flex-col my-24 flex justify-center items-center fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
            <p v-if="loggingIn" class=" text-green-600 text-sm mb-5">Logging in, redirecting...</p>
            <p v-if="incorrect" class=" text-red-600 text-sm mb-5">Incorrect Password Or Username</p>
            <div class="flex align-middle justify-center">
                <button @click="submitData()" type="button" class=" text-white hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center border-2 dark:hover:bg-gray-500 dark:focus:ring-blue-800">Submit</button>
            </div>
            <div class="flex align-middle justify-center">
                <a class="cursor-pointer text-sm text-gray-400 mt-5">Dont have an account? Sign up.</a>
            </div>

        </form>
    </div>

</template>
    
<script>
import { ref } from 'vue'
import axios from 'axios'
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import { initFlowbite, Modal } from 'flowbite'
export default {
    name: 'search',
    setup() {
        
        const router = useRouter()
        const store = useStore()
        return { router, store }

    },
    props: {
        show: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        auth() {
            return this.$store.state.auth
        },
        showModal() {
            return this.show
        }
    },
    mounted() {
        this.showModal
        initFlowbite()
    },
    data() {
        return {
            showLogin: false,
            // The payload we will send to the api
            login: {
                email: '',
                password: '',
            },
            // Used for displaying the incorrect password or username message
            incorrect: false,
            loggingIn: false,
            
            // The headers we will send to the api
            headers: {
                Accept: 'application/json',
                'content-type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'}
        }
    },
    methods: {
        async getUser() {
            const response = await axios.get('http://127.0.0.1:8000/api/user', {headers: this.headers, withCredentials: true})
            console.log(response.status)
            if (response.status == 200) {
                return true
            } else {
                return false
            }
        
        },
        // Called when the submit button is clicked
        async submitData() {
            try {
                // If the email or password is empty we will return
                if(this.login.email == '' || this.login.password == '') {
                    return;
                }

                // Otherwise we will make a request to the api and set the answer array to the response
                const response = await axios.post('http://127.0.0.1:8000/api/login', this.login, {headers: this.headers, withCredentials: true})
                
                // If the response is 401 we will set the incorrect variable to true
                if (response.status == 401) {
                    return this.incorrect = true
                }

                // Otherwise we will set the authentication variable to true and redirect to the users code page
                this.loggingIn = true
                const user = await axios.get('http://127.0.0.1:8000/api/user', {headers: this.headers, withCredentials: true})
                await this.$store.dispatch('setAuthentication', true)
                await this.$store.dispatch('setUserID', user.data["id"])
                await this.$router.push("/user/" + user.data["id"] + "/code")            

            } // Error handling 
            catch(e) {
                this.incorrect = true
                console.log(e)
            }

        },
        // Called when the sign up button is clicked
        async signUp() {
            await this.$router.push("/register")
        }
    }
    }
    
</script>
