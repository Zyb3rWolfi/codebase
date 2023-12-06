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
                <input v-model="login.email" @keyup.enter="submitData()" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@example.com" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                <input v-model="login.password" @keyup.enter="submitData()" type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <p v-if="loggingIn" class=" text-green-600 text-sm mb-5">Logging in, redirecting...</p>
            <p v-if="incorrect" class=" text-red-600 text-sm mb-5">Incorrect Password Or Username</p>

            <div class="mt-1 mb-5 justify-center justify-items-center container grid grid-rows-1">
                <div class=" row-start-1">

                    <button @click="loginOauth()" type="button" class=" mr-5 pl-5 pr-5 pt-2 pb-2 bg-white rounded-xl">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="black" viewBox="0 0 18 19">
                            <path fill-rule="evenodd" d="M8.842 18.083a8.8 8.8 0 0 1-8.65-8.948 8.841 8.841 0 0 1 8.8-8.652h.153a8.464 8.464 0 0 1 5.7 2.257l-2.193 2.038A5.27 5.27 0 0 0 9.09 3.4a5.882 5.882 0 0 0-.2 11.76h.124a5.091 5.091 0 0 0 5.248-4.057L14.3 11H9V8h8.34c.066.543.095 1.09.088 1.636-.086 5.053-3.463 8.449-8.4 8.449l-.186-.002Z" clip-rule="evenodd"/>
                        </svg>
                    </button>
    
                    <button @click="discordLogin()" type="button" class=" pl-5 pr-5 pt-2 pb-2 bg-neutral-800 rounded-xl">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>
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
                <input v-model="signup.name" @keyup.enter="submitDataRegister()" type="text" id="Regname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <div class="mb-6">
                <label for="Regemail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                <input v-model="signup.email" @keyup.enter="submitDataRegister()" type="email" id="Regemail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@example.com" required>
            </div>
            <div class="mb-6">
                <label for="Regpassword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" >Your password</label>
                <input v-model="signup.password" @keyup.enter="submitDataRegister()" type="password" id="Regpassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <p v-if="this.accountExists" class=" text-red-600 text-sm mb-5">Account With This Email Already Exists!</p>
            <p v-if="this.passwordTooShort" class=" text-red-600 text-sm mb-5">The Password Should Be 8 Characters Or Longer</p>
            <p v-if="loggingIn" class=" text-green-600 text-sm mb-5">Logging in, redirecting...</p>
            
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
import { ref, onMounted, resolveComponent } from 'vue'
import axios from 'axios'
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import { initFlowbite, Modal } from 'flowbite'
import { useAuth0 } from '@auth0/auth0-vue';
const apiUrl = import.meta.env.VITE_API_BASE_URL

export default {
    name: 'search',
    setup() {

        const { loginWithRedirect } = useAuth0()
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
                'X-Requested-With': 'XMLHttpRequest',
                'Authorization': 'Bearer ' + localStorage.getItem('token')},
            
        }
    },
    methods: {
        loginOauth() {
            window.location.href = 'http://localhost:8000/auth/google'
        },
        discordLogin() {
            window.location.href = 'http://localhost:8000/auth/github'
        },
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
            axios.post(apiUrl + '/api/register', this.signup).then(async () => {
                this.login.email = this.signup.email
                this.login.password = this.signup.password

                await axios.post(apiUrl + '/api/login', this.login, {headers: this.headers, withCredentials: true}).then(async response => {
                    
                    localStorage.setItem('token', response.data["token"])


                    const headerss = {
                        Accept: 'application/json',
                        'content-type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Authorization': 'Bearer ' + localStorage.getItem('token')}

                    const user = await axios.get(apiUrl + '/api/user', {headers: headerss, withCredentials: true}).then(async user => {
                        await this.store.dispatch('setAuthentication', true)
                        await this.store.dispatch('setUserID', user.data["id"])
                        await this.router.push("/user/" + user.data["id"] + "/code")
                        this.router.push("/user/" + user.data["id"] + "/code")

                        this.store.dispatch('setSignupModalState', 0)
                        this.loggingIn = true
                    })
                })

            }).catch(error => {
            console.log(error)
                this.accountExists = true
            })
            
        },

        // Called when the submit button is clicked
        async submitData() {
            console.log("submitting data")

            try {
                // If the email or password is empty we will return
                if(this.login.email == '' || this.login.password == '') {
                    throw new Error("Email or password is empty");
                }

                // Otherwise we will make a request to the api and set the answer array to the response
                const response = await axios.post(apiUrl + '/api/login', this.login, {headers: this.headers, withCredentials: true})
                localStorage.setItem('token', response.data["token"])
                
                // If the response is 401 we will set the incorrect variable to true
                if (response.status == 401) {
                    return this.incorrect = true
                }

                // Otherwise we will set the authentication variable to true and redirect to the users code page
                this.loggingIn = true
                const user = await axios.get(apiUrl + '/api/user', {headers: {
                    Accept: 'application/json',
                    'content-type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')

                }, withCredentials: true})
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
