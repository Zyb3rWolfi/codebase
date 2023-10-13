<template>
    <div class="md:container mx-auto contain flex-col my-36 flex justify-center items-center">
        <form class=" col-start start-3">
            <p class=" text-center text-2xl font-bold mb-5">Sign In</p>
            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                <input v-model="login.email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                <input v-model="login.password" type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <div class="flex items-start mb-6">
                <div class="flex items-center h-5">
                <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                </div>
                <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
            </div>
            <p>{{ login }}</p>
            <button @click="Check()" type="button" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Check</button>
            <button @click="submitData()" type="button" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </div>

</template>
    
<script>
import axios from 'axios'
export default {
    name: 'search',
    data() {
        return {
            login: {
                email: '',
                password: '',
            },
            headers: {
                Accept: 'application/json',
                'content-type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'}
        }
    },
    methods: {
        async submitData() {
            const response = await axios.post('http://127.0.0.1:8000/api/login', this.login, {headers: this.headers, withCredentials: true})
            return console.log(response)
        },
        async Check() {
            const response = await axios.get('http://127.0.0.1:8000/api/user', {headers: this.headers, withCredentials: true})
            return console.log(response)
        }
    }
    }
    
</script>