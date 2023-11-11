<template class="">
    <div class="grid lg:grid-cols-6 sm:grid-cols-4 md:cols-4 mx-auto justify-center">
        <p class="text-2xl font-semibold col-start-2">Account Settings</p>
        <p class="mt-5 mb-5 font-semibold col-start-2">Your Details</p>
        <div class="container grid col-start-2">
        <form class="row-start-1">
            <div class="relative z-0 w-full mb-6 group">
        <input v-model="user_name" type="text" name="floating_name" id="floating_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Your Name</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input v-model="user_email" type="email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
                <p v-if="changed" class=" text-sm mt-2 text-gray-400">Your Details Where Changed</p>
            </div>
            <button @click="changeDetails()" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Change</button>
            <p class="mt-5 mb-5 font-semibold">Change Password</p>
            <div class="relative z-0 w-full mb-6 group">
                <input v-model="user_password" type="password" name="floating_password" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Old Password</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input v-model="user_new_password" type="password" name="new_password" id="floating_new_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="floating_new_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                <p v-if="changed2" class=" text-sm mt-2 text-gray-400">Your Details Where Changed</p>
            </div>
            <button @click="changePassword()" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirm</button>
        </form>
        </div>
    </div>
    
</template>

<script>
import { onMounted, ref, computed, onBeforeMount } from 'vue'
import axios from 'axios';

export default  {
    data() {
        return {
            user_name: '',
            user_email: '',
            user_password: '',
            user_new_password: '',

            accountDetails: {
                name: '',
                email: '',
            },
            changed: false,
            changed2: false,
    }
},

async mounted() {
    const data = await this.getUser()
},

methods: {
    // Get user details
    async getUser() {
        await axios.get('http://127.0.0.1:8000/api/user', {headers: headers, withCredentials: true}).then(response => {
        this.user_name = response.data["name"], this.user_email = response.data["email"]})
},
    
        // Details change request
async changeDetails() {
    this.accountDetails.user_name = this.user_name
    this.accountDetails.user_email = this.user_email

    const response = await axios.post('http://127.0.0.1:8000/api/changedetails', this.accountDetails, {headers: headers, withCredentials: true})
    this.changed = true
    },

    // Password change request
    async changePassword() {
    this.accountDetails.user_password = this.user_password
    this.accountDetails.user_new_password = this.user_new_password

    const response = await axios.post('http://127.0.0.1:8000/api/changePassword', this.accountDetails, {headers: headers, withCredentials: true})
    this.changed2 = true

}
},

}

const headers = {
    Accept: 'application/json',
    'content-type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest'
}

</script>