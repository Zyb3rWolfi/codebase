<template class="">
    <div class="grid lg:grid-cols-6 sm:grid-cols-4 md:cols-4 mx-auto justify-center">
        <p class="text-2xl font-semibold col-start-2">Account Settings</p>
        <p class="mt-5 mb-5 font-semibold col-start-2">Your Details</p>
        <div class="container grid col-start-2">
        <form class="row-start-1">
            <div class="relative z-0 w-full mb-6 group">
        <input v-model="user_name" type="text" name="floating_name" id="floating_name" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2  appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " required />
        <label for="floating_name" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Your Name</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input v-model="user_email" type="email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2  appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " required />
                <label for="floating_email" class="peer-focus:font-medium absolute text-sm  text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
                <p v-if="changed" class=" text-sm mt-2 text-gray-400">Your Details Where Changed</p>
                <p v-if="emailAlreadyExists" class=" text-sm mt-2 text-gray-400">Email Already Exists!</p>
            </div>
            <button @click="changeDetails()" type="button" class="text-white  focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Change</button>
            <p class="mt-5 mb-5 font-semibold">Change Password</p>
            <div class="relative z-0 w-full mb-6 group">
                <input v-model="user_password" type="password" name="floating_password" id="floating_password" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-600 appearance-none text-white border-gray-600focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Old Password</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input v-model="user_new_password" type="password" name="new_password" id="floating_new_password" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="floating_new_password" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                <p v-if="changed2" class=" text-sm mt-2 text-gray-400">Your Details Where Changed</p>
                <p v-if="textToggle" class=" text-sm mt-2 text-gray-400">{{ textPlaceholder }}</p>
            </div>
            <button @click="changePassword()" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirm</button>
        </form>
        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button" class="text-white mt-10 bg-red-800 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Delete Account</button>
        </div>
    </div>
    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete your account?</h3>
                <button @click="deleteAccount()" data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
const apiUrl = import.meta.env.VITE_API_BASE_URL
import { initFlowbite } from 'flowbite'

export default  {
    // Returns all data that is associated with the account 
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
            emailAlreadyExists: false,
            textPlaceholder: 'placeholder',
            textToggle: false,
    }
},

async mounted() {   // I am 99% sure that this is a typo and it does nothing but im scared to delete it
    const data = await this.getUser()
    initFlowbite()
},

methods: {
    // Get user details
    async getUser() {
        await axios.get(apiUrl + '/api/user', {headers: headers, withCredentials: true}).then(response => {
        this.user_name = response.data["name"], this.user_email = response.data["email"]})
},

    deleteAccount() {
        axios.post(apiUrl + '/api/deleteAccount', [], {headers: headers, withCredentials: true}).then(response => {
            localStorage.removeItem('token')
            window.location.href = '/'
        })
    },

        // Details change request
async changeDetails() {
    
    this.accountDetails.user_name = this.user_name
    this.accountDetails.user_email = this.user_email

    // calls the api to change the details
    await axios.post(apiUrl + '/api/changedetails', this.accountDetails, {headers: headers, withCredentials: true}).then(response => {
        this.changed = true
        this.emailAlreadyExists = false
    }).catch(error => {
        this.emailAlreadyExists = true // If the email already exists we will enable the prompt
    })
},
    // Password change request
    async changePassword() {
    this.textToggle = false
    this.accountDetails.user_password = this.user_password
    this.accountDetails.user_new_password = this.user_new_password
    
    // Checks if the new password is long enough
    // Changes place holder if this is not the case
    if (this.accountDetails.user_new_password.length < 8) {
        this.textPlaceholder = 'Password must be at least 8 characters long'
        this.textToggle = true
        return
    }

    // Checks if the new password is the same as the old password
    // Changes place holder if this is the case
    if (this.accountDetails.user_new_password == this.accountDetails.user_password) {
        this.textPlaceholder = 'New password must be different from old password'
        this.textToggle = true
        return
    }

    // calls the api to change the password
    await axios.post(apiUrl + '/api/changePassword', this.accountDetails, {headers: headers, withCredentials: true}).then(response => {
        this.changed2 = true
    }).catch(error => {
        this.textPlaceholder = 'Old password is incorrect'
        this.textToggle = true
    })
}
},

}

// Headers for the api requests
const headers = {
    Accept: 'application/json',
    'content-type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest',
    'Authorization': 'Bearer ' + localStorage.getItem('token')
}

</script>