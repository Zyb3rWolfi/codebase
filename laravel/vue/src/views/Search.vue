<template>
    <div class="md:container mx-auto mt-52 lg:max-w-screen-md md:max-w-screen-sm sm:max-w-screen-sm">
        <div class="text-center my-6">
            <p id="searchTitle" class="text-4xl">Search Engine For Code</p>
        </div>
        <div class="">
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
            search: {
                title: '',
                languages: '',
            },
            auth: null,
            header: {
                Accept: 'application/json',
                'content-type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            languages: [],
            selectedLanguages: [],
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
                this.languages.push(getBlocks.data["strings"][i]["language"]);
        };
        },
        async getResponse() {
            // If the search is empty we will empty the answer array and return
            if (this.search.title === '') {
                this.answer = {};
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