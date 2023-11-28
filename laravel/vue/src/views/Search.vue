<template>
    <div class="md:container mx-auto mt-52 lg:max-w-screen-md md:max-w-screen-sm sm:max-w-screen-sm">
        <div class="text-center my-6">
            <p id="searchTitle" class="text-4xl">Search Engine For Code</p>
        </div>
        <div >
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <div class=" flex">
                        <input v-model="search" type="search" id="default-search" class=" rounded-xl block w-full p-4 pl-10 text-sm0 border bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Center a DIV..." required>
                        <button data-popover-placement="bottom" data-popover-target="searchFilter" class="ml-5 bg-blue-700 p-2 rounded-lg">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                <path d="M18.85 1.1A1.99 1.99 0 0 0 17.063 0H2.937a2 2 0 0 0-1.566 3.242L6.99 9.868 7 14a1 1 0 0 0 .4.8l4 3A1 1 0 0 0 13 17l.01-7.134 5.66-6.676a1.99 1.99 0 0 0 .18-2.09Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
        </div>
    </div>
    <div id="searchFilter" role="tooltip" class="absolute z-10 invisible inline-block text-sm transition-opacity duration-300 border rounded-lg shadow-sm opacity-0 text-gray-400 border-gray-600 bg-gray-800">
        <div class="px-3 py-2 border-b rounded-t-lg border-gray-600 ">
            <h3 class="font-semibold text-gray-900 dark:text-white">Filters</h3>
        </div>
        <div class="px-3 py-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Languages</label>
            <ul class=" grid ">
                <li v-for="lang in languages">
                    <label class="inline-flex items-center mt-3">
                        <input v-model="selectedLanguages" type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" :value="lang">
                        <span class="ml-2 text-gray-700 dark:text-gray-400">{{ lang }}</span>
                    </label>
                </li>
            </ul>
        </div>
        <div data-popper-arrow></div>
  </div>
    <div class="my-10">
        <p class="text-center text-2xl font-bold mb-5">Search Results</p>
        <div class="grid mx-auto grid-cols-1  gap-5 justify-items-center">
            <div v-if="loading" role="status" class=" mt-20">
                <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
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
import { initFlowbite } from 'flowbite';
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
            },
            languages: [],
            selectedLanguages: [],
            languageSet: new Set(),
            sendData: {
                title: '',
                filters: 'python'
            },
            loading: false
        }
    },
    mounted() {
        initFlowbite();
        document.documentElement.style.overflow = 'auto';

        this.updateFilters()
    },
    components: {
        Result,
        NavBar,
    },
    methods: {
        async updateFilters() {
            const getBlocks = await axios.get(apiUrl + '/api/getBlocks', {headers: this.header, withCredentials: true});
            for (var i = 0; i < getBlocks.data["strings"].length; i++) {
                
                this.languageSet.add(getBlocks.data["strings"][i]["language"])
            };
            this.languages = Array.from(this.languageSet)
        },
        async getResponse() {
            var payload = {
                title: '',
                filters: []
            }
            if (this.search == '') {
                this.answer = {}
                return
            }

            this.loading = true
            payload.title = this.search
            payload.filters = this.selectedLanguages
            console.log(this.sendData)
            // Otherwise we will make a request to the api and set the answer array to the response
            const response = await axios.post(apiUrl + '/api/test', payload, {headers: this.header, withCredentials: true});
            this.answer = response.data["strings"];

            this.loading = false
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