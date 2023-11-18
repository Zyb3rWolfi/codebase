<template>
<div id="loginRegisterModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div v-show="this.store.state.SignupModalState == 1" class=" md:container mx-auto flex-col flex justify-center items-center fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <form class=" col-start start-3 p-16 rounded-2xl shadow-xl" style="background-color: #23272f;">
            <!-- Modal header -->
            <div class="flex items-center justify-left p-4 md:p-5 border-b rounded-t dark:border-gray-600 mb-4">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Sign in
                </h3>
                <button id="closeButton" type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
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
                <button id="submitButton" @click="submitData()" type="button" class=" text-white hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center border-2 dark:hover:bg-gray-500 dark:focus:ring-blue-800">Submit</button>
            </div>
            <div class="flex align-middle justify-center">
                <a @click="this.store.dispatch('setSignupModalState', 2)"  class="cursor-pointer text-sm text-gray-400 mt-5">Dont have an account? Sign up.</a>
            </div>

        </form>
    </div>

    <div v-show="this.store.state.SignupModalState == 2" class="md:container mx-auto contain flex-col my-20 flex justify-center items-center">
        <form class=" col-start p-16 rounded-2xl start-3 shadow-xl" style="background-color: #23272f;">
            <div class="flex items-center justify-left p-4 md:p-5 border-b rounded-t dark:border-gray-600 mb-4">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Sign up
                </h3>
                <button id="closeButtonRegister" type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>            
            <div class="mb-6">
                <label for="Regname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your name</label>
                <input v-model="signup.name" type="text" id="Regname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <div class="mb-6">
                <label for="Regemail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                <input v-model="signup.email" type="email" id="Regemail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required>
            </div>
            <div class="mb-6">
                <label for="Regpassword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                <input v-model="signup.password" type="password" id="Regpassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <p v-if="this.accountExists" class=" text-red-600 text-sm mb-5">Account With This Email Already Exists!</p>
            <p v-if="this.passwordTooShort" class=" text-red-600 text-sm mb-5">The Password Should Be 8 Characters Or Longer</p>
            <div class="flex align-middle justify-center">
                <button id="submitButtonRegister" @click="submitDataRegister() " type="button" class=" text-white hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center border-2 dark:hover:bg-gray-500 dark:focus:ring-blue-800">Submit</button>
            </div>
            <div class="flex align-middle justify-center">
                <a @click="this.store.dispatch('setSignupModalState', 1)" class="cursor-pointer text-sm text-gray-400 mt-5">Already have an account?</a>
            </div>
        </form>
    </div>
</div>

</template>
    
<script>
import { ref, onMounted } from 'vue'
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
            default: false,
        },

    },
    computed: {
        auth() {
            return this.store.state.auth   
        },

    },
    mounted() {
        initFlowbite()
    },
    data() {
        return {
            signup: {
                name: '',
                email: '',
                password: '',
            },
            // The payload we will send to the api
            login: {
                email: '',
                password: '',
            },
            // Used for displaying the incorrect password or username message
            incorrect: false,
            loggingIn: false,
            accountExists: false,
            passwordTooShort: false,
            
            // The headers we will send to the api
            headers: {
                Accept: 'application/json',
                'content-type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'},
            
        }
    },
    methods: {
        // Submits the data to the api
        async submitDataRegister() {

            // If any of the fields are empty we will return
            if (this.signup.name === '' || this.signup.email === '' || this.signup.password === '') {
                return
            } else if (this.signup.password.length < 8) {
                this.passwordTooShort = true
                return
            }
            // Otherwise we will make a post request to the api
            axios.post('http://127.0.0.1:8000/api/register', this.signup).then(async () => {
                this.login.email = this.signup.email
                this.login.password = this.signup.password

                await axios.post('http://127.0.0.1:8000/api/login', this.login, {headers: this.headers, withCredentials: true}).then(async () => {
                    const user = await axios.get('http://127.0.0.1:8000/api/user', {headers: this.headers, withCredentials: true}).then(async () => {
                        await this.store.dispatch('setAuthentication', true)
                        await this.store.dispatch('setUserID', user.data["id"])
                        await this.router.push("/user/" + user.data["id"] + "/code")
                        this.router.push("/user/" + user.data["id"] + "/code")

                        this.store.dispatch('setSignupModalState', 0)
                    })
                })

            }).catch(error => {
                this.accountExists = true
            })
            
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
                
                this.loggingIn = false


            } // Error handling 
            catch(e) {
                this.incorrect = true
            }

        },
        // Called when the sign up button is clicked
        async signUp() {
            await this.$router.push("/register")
        }
    }
    }

    
</script>
