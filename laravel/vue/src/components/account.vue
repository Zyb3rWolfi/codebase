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
            
            <h3 class="mb-5 text-lg font-medium mt-5 text-gray-900 dark:text-white">Auth Method</h3>
            <ul class="grid w-full gap-6 md:grid-cols-3">
                <li id="google" class="" @click="addGoogle()">
                    <label for="react-option" class="inline-flex items-center justify-center w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                        <div class="block">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 19">
                                 <path fill-rule="evenodd" d="M8.842 18.083a8.8 8.8 0 0 1-8.65-8.948 8.841 8.841 0 0 1 8.8-8.652h.153a8.464 8.464 0 0 1 5.7 2.257l-2.193 2.038A5.27 5.27 0 0 0 9.09 3.4a5.882 5.882 0 0 0-.2 11.76h.124a5.091 5.091 0 0 0 5.248-4.057L14.3 11H9V8h8.34c.066.543.095 1.09.088 1.636-.086 5.053-3.463 8.449-8.4 8.449l-.186-.002Z" clip-rule="evenodd"/>
                            </svg>                
                        </div>
                    </label>
                </li>
                <li id="github" @click="addGithub()">
                    <label for="flowbite-option" class="inline-flex items-center justify-center w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd"/>
                                </svg>    
                        </div>
                    </label>
                </li>
                <li data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" id="null">
                    <label for="angular-option" class="inline-flex items-center justify-center w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                <path d="M16 0H4a2 2 0 0 0-2 2v1H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4.5a3 3 0 1 1 0 6 3 3 0 0 1 0-6ZM13.929 17H7.071a.5.5 0 0 1-.5-.5 3.935 3.935 0 1 1 7.858 0 .5.5 0 0 1-.5.5Z"/>
                            </svg>
                        </div>
                    </label>
                </li>
            </ul>
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


        <!-- Main modal -->
        <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Setup password login
                        </h3>
                        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <div class="space-y-4" action="#">
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                                <input v-model="setPassword" type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <button @click="this.setPasswordForUser()" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Turn on password login</button>
                        </div>
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
            setPassword: '',
            changed: false,
            changed2: false,
            emailAlreadyExists: false,
            textPlaceholder: 'placeholder',
            textToggle: false,
    }
},

async mounted() {   // I am 99% sure that this is a typo and it does nothing but im scared to delete it
    const data = await this.getUser()

    await axios.get(apiUrl + '/api/getConnections', {headers: headers, withCredentials: true}).then(response => {
        console.log(response.data)
        for (let i = 0; i < response.data.length; i++) {
            const target = document.getElementById(response.data[i]["provider"])
            target.classList.add('active')
        }

    })
    

    initFlowbite()
},

methods: {

    async addGithub() {
        await axios.get(apiUrl + '/api/user', {headers: headers, withCredentials: true}).then(response => {
            const id = response.data["id"]
            window.location.href = `http://localhost:8000/auth/github?id=${id}` 
        
        })
    },
    async addGoogle() {
        await axios.get(apiUrl + '/api/user', {headers: headers, withCredentials: true}).then(response => {
            const id = response.data["id"]
            window.location.href = `http://localhost:8000/auth/google?id=${id}` 
        
        })
    },
    // Get user details
    async getUser() {
        await axios.get(apiUrl + '/api/user', {headers: headers, withCredentials: true}).then(response => {
        this.user_name = response.data["name"], this.user_email = response.data["email"]
    })
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
async setPasswordForUser() {
    console.log(this.setPassword)
    await axios.post(apiUrl + '/api/addPassword', this.setPassword, {headers: headers, withCredentials: true}).then(response => {
       console.log(response.data)
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

<style scoped>

.active {
    border: white solid 2px;
    border-radius: 10%;
}

</style>