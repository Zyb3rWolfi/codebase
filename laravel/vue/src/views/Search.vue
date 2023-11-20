<template>
    <div class="md:container mx-auto mt-52 lg:max-w-screen-md md:max-w-screen-sm sm:max-w-screen-sm">
        <div class="text-center my-6">
            <p id="searchTitle" class="text-4xl">Search Engine For Code</p>
        </div>
        <div class="">
            <form> 
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input v-model="search" type="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Center a DIV..." required>
                </div>
            </form>
        </div>
    </div>
    <div class="my-10">
        <p class="text-center text-2xl font-bold mb-5">Search Results</p>
        <div class="grid mx-auto grid-cols-1  gap-5 justify-items-center">
            <Result v-if="answer.length > 0" v-for="ans in answer" :search="ans" :key="ans.id"></Result>
        </div>
    </div>

</template>
    
<script>
import NavBar from '../components/navbar.vue';
import axios from 'axios';
import { ref, watch } from 'vue';
import Result from '../components/result.vue';
const apiUrl = import.meta.env.VITE_API_BASE_URL
export default {
    name: 'search',
    setup() {
  },
    data() {
        return {
            answer: {},
            search: '',
            auth: null,
            header: {
                Accept: 'application/json',
                'content-type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        }
    },
    mounted() {
        document.documentElement.style.overflow = 'auto';
    },
    components: {
        Result,
        NavBar,
    },
    methods: {
        async getResponse() {
            // If the search is empty we will empty the answer array and return
            if (this.search === '') {
                this.answer = [];
                return;
            }
            // Otherwise we will make a request to the api and set the answer array to the response
            const response = await axios.get(apiUrl + '/api/test/' + this.search, {headers: this.header, withCredentials: true});
            this.answer = response.data["strings"];
            },
        
        },
        watch: {
            // Watches the search variable and calls the getResponse function when it changes
            search() {
                this.getResponse();
            }
        },
        // Calls the getResponse function when the component is mounted
        beforeMount() {
            this.getResponse();
        },
    }
</script>