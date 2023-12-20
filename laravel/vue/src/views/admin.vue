<template>
    <div class="flex flex-cols-2 gap-4 justify-evenly w-auto mt-24">
       <div class=" max-w-max p-9 text-4xl border-b-8">
            <div class="flex flex-row justify-between">
                <h3><pre>Total Users : </pre></h3>
                <h3 class=" text-green-600">{{totalUsers}}</h3>
            </div>
       </div>
        <div class=" max-w-max  p-9 content-center text-4xl border-b-8">
            
            <div v-if="newUsers != 0" class="flex flex-row justify-between">
                <h3><pre>New Users : </pre></h3>
                <h3 class=" text-green-600">{{newUsers}}</h3>
            </div>

            <div v-if="newUsers == 0" class="flex flex-row justify-between">
                <h3><pre>New Users : </pre></h3>
                <h3 class=" text-red-600">{{newUsers}}</h3>
            </div>
        </div> 
    </div>
    <div class="md:container mx-auto mt-52 lg:max-w-screen-md md:max-w-screen-sm sm:max-w-screen-sm">
        <div class="text-center my-6">
            <p id="searchTitle" class="text-4xl">Search For A User</p>
        </div>
        <div >
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
            </div>
                <input v-model="search" type="search" id="default-search" class=" rounded-xl block w-full p-4 pl-10 text-sm0 border bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Center a DIV..." required>
            </div>
        </div>
    </div>
    <div class="grid mx-auto grid-cols-1  justify-items-center mt-20">
        <div class=" w-4/5 ">
        <div class="grid grid-row ">
                <div class="grid grid-cols-4  ">          
                    <h3 class=" text-xl font-extrabold text-left p-3 border-r-2 border-l-2 ">ID</h3>
                    <h3 class=" text-xl font-extrabold overflow-hidden p-3 border-r-2 ">Name</h3>
                    <h3 class=" text-xl font-extrabold overflow-hidden p-3 border-r-2 ">Email</h3>
                </div>
            </div>
        </div>
        <hr class="w-4/5 border-4"> 
        
        <div v-if="loading" class="text-center mt-16">
            <div role="status">
                <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <userPreview v-if="!loading"  v-for="user in userPreviews" id :user="user"></userPreview>    
    </div>
</template>

<script setup>

    import { onMounted, ref, watch } from 'vue';
    import axios from 'axios';
    import userPreview from '../components/userPreiew.vue';
    import debounce from 'lodash/debounce';

    var totalUsers = ref(0)
    var newUsers = ref(0)
    const apiUrl = import.meta.env.VITE_API_BASE_URL // Api Url from .evn file
    var userPreviews = ref([])
    var loading = ref(true)
    var search = ref("")
    var titles = {
        id: "Id",
        name: "Name",
        email: "Email"
    }

    
    async function gettotalUsers() {
        const headers = {
          Accept: 'application/json',
          'content-type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        }
          const response = await axios.get(apiUrl + '/api/userCount', {headers: headers, withCredentials: true}).then(function(response) {
            totalUsers.value = response.data["count"]
          })
    }

    async function getnewUsers() {
        const headers = {
          Accept: 'application/json',
          'content-type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        }
          const response = await axios.get(apiUrl + '/api/newUserCount', {headers: headers, withCredentials: true}).then(function(response) {
            newUsers.value = response.data["count"]
          })
    }


    const getUserPreviews = debounce(async(search) => {
 
        loading.value = true
        var payload = {
            name : search
        }
        const headers = {
          Accept: 'application/json',
          'content-type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        }
          const response = await axios.post(apiUrl + '/api/getUserPreviews', payload, {headers: headers, withCredentials: true}).then(function(response) {
            userPreviews.value = response.data["strings"]
            loading.value = false
          })
    }, 250)

    onMounted(() => {

            gettotalUsers();
            getnewUsers();
            getUserPreviews();
            
        })

    watch(search, async (newSearch, oldSearch) =>{

        getUserPreviews(newSearch);

    })

</script>