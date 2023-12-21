<template>

    <div v-if="notDeleted" :id="user.id" >
        <div class="grid grid-row ">
                <div class="grid grid-cols-4  ">          
                    <h1 class=" text-xl font-bold text-left p-3 border-r-2 border-l-2 border-b-2">{{user.id}}</h1>
                    <h1 class=" text-xl font-bold overflow-hidden p-3 border-r-2 border-b-2">{{ user.name }}</h1>
                    <h1 class=" text-xl font-bold overflow-hidden p-3 border-r-2 border-b-2">{{ user.email }}</h1>
                    <div class="flex flex-row justify-evenly border-b-2">
                        <button :data-modal-target="user.id + 'removeConfirm'" :data-modal-toggle="user.id + 'removeConfirm'" class=" bg-transparent">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                            </svg>
                        </button>
                        <button @click="getUserDetails()" :data-modal-target="user.id + 'Details'" :data-modal-toggle="user.id + 'Details'" class=" bg-transparent hover:text-gray-300 ">
                            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                <path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"/>
                                <path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
                <!--This modal shows a confirmation screen-->
        <div :id="user.id + 'removeConfirm'" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative  rounded-lg shadow bg-gray-700">
                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white" :data-modal-hide="user.id + 'removeConfirm'">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this user?</h3>
                        <button @click="deleteAccount()" :data-modal-hide="user.id + 'removeConfirm'" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none  focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                            Yes, I'm sure
                        </button>
                        <button :data-modal-hide="user.id + 'removeConfirm'" type="button" class=" focus:ring-4 focus:outline-none  rounded-lg border  text-sm font-medium px-5 py-2.5  focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white">No, cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <div :id="user.id + 'Details'" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-5xl max-h-full">
            <div class="relative rounded-lg shadow bg-gray-700">
                <button :data-modal-hide="user.id + 'Details'" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparentrounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3  class="mb-4 text-xl font-medium text-white">Name : {{user.name}}</h3>
                    <h3  class="mb-4 text-xl font-medium text-white">Email : {{user.email}}</h3>
                    <h3  class="mb-4 text-xl font-medium text-white">ID : {{user.id}}</h3>

                    <div v-if="detailsLoading" class="text-center mt-16">
                        <div role="status">
                            <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div v-if="!detailsLoading">

                        <h3  class="mb-4 text-xl font-medium text-white">Created at : {{userDetails.created_at}}</h3>
                        <h3  class="mb-4 text-xl font-medium text-white">Last Updated : {{userDetails.updated_at}}</h3>
                        
                        <h3  class="mb-4 text-xl font-medium text-white">Connections :{{userDetails.connections.split("undefined")[userDetails.connections.split("undefined").length -1]}}</h3>


                        <router-link type="button" class="w-full text-white  focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800" active-class="active" :to="'/user/' + user.id + '/code'" >View users blocks</router-link>

                    </div>
                </div>
            </div> 
            </div>
        </div>
    
</template>

<script setup>
    import { initFlowbite } from 'flowbite'
    import { onMounted, ref } from 'vue';
    import axios from 'axios';
    import { RouterLink } from 'vue-router';



    const apiUrl = import.meta.env.VITE_API_BASE_URL // Api Url from .evn file

    onMounted(() => { // runs after the component is mounted
        initFlowbite()
    })

    var detailsLoading = ref(true)

    var userDetails = ref({})

    var notDeleted = ref(true)

    const headers = {
          Accept: 'application/json',
          'content-type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'Authorization': 'Bearer ' + localStorage.getItem('token')
    }

    const props = defineProps(['user'])

    const getUserDetails = async() => {
        detailsLoading.value = true
        var payload = {
            id : props.user.id    
        }
          const response = await axios.post(apiUrl + '/api/getUserByID', payload, {headers: headers, withCredentials: true}).then(function(response) {
            userDetails.value = response.data["strings"][0]
            response.data["connections"].forEach(element => {
                userDetails.value.connections = userDetails.value.connections + " " + element["provider"]                
            });
          })
        detailsLoading.value = false
    }

    const deleteAccount = function() {
        var payload = {
            id : props.user.id
        }
        axios.post(apiUrl + '/api/adminDeleteAccount', payload, {headers: this.headers, withCredentials: true}).then(response => {
            if (response.data["message"] == "success") {
                notDeleted.value = false
            }
        })
    }

</script>