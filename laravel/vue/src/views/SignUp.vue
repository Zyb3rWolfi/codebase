<template>
    <div class="md:container mx-auto contain flex-col my-20 flex justify-center items-center">
        <form class=" col-start p-16 rounded-2xl start-3 shadow-xl" style="background-color: #23272f;">
            <p id="loginTitle" class=" text-center text-2xl font-bold mb-5">Sign Up</p>
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
            <div class="flex align-middle justify-center">
                <button @click="submitData()" type="button" class=" text-white hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center border-2 dark:hover:bg-gray-500 dark:focus:ring-blue-800">Submit</button>
            </div>
            <div class="flex align-middle justify-center">
                <a class="cursor-pointer text-sm text-gray-400 mt-5">Already have an account?</a>
            </div>
        </form>
    </div>

</template>
    
<script>
import axios from 'axios'
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

export default {
    name: 'signup',
    setup() {
        const router = useRouter()
        const store = useStore()
        return { router, store }
    },

    data() {
        return {
            // The payload we will send to the api
            signup: {
                name: '',
                email: '',
                password: '',
            },
            login: {
                email: '',
                password: '',
            },
            // Headers we will send to the api
            headers: {
                Accept: 'application/json',
                'content-type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'}
        }
    },
    methods: {
        // Submits the data to the api
        async submitData() {
            console.log("Submitting data...")
            // If any of the fields are empty we will return
            if (this.signup.name === '' || this.signup.email === '' || this.signup.password === '') {
                return
            }
            // Otherwise we will make a post request to the api
            await axios.post('http://127.0.0.1:8000/api/register', this.signup)
            this.login.email = this.signup.email
            this.login.password = this.signup.password
            // Then we will sign the user in
            const response = await axios.post('http://127.0.0.1:8000/api/login', this.login, {headers: this.headers, withCredentials: true})
            console.log(response)

            const user = await axios.get('http://127.0.0.1:8000/api/user', {headers: this.headers, withCredentials: true})
            await this.store.dispatch('setAuthentication', true)
            await this.store.dispatch('setUserID', user.data["id"])
            await this.router.push("/user/" + user.data["id"] + "/code")
            this.router.push("/user/" + user.data["id"] + "/code")
            console.log("Redirecting...")
        },
    }
}

</script>