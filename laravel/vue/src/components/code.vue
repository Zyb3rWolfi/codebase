<template>
    <p class=" text-2xl font-semibold">Code Blocks</p>
    <div class="grid grid-cols-4 w-auto mt-10 gap-10">
        <codeBlock v-for="ans in answer" :search="ans" />
        <div class=" my-auto">
            <button type="button" class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
            <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
            </svg>
            </button>  
        </div>
    </div>
</template>

<script>
import { onBeforeMount } from 'vue';
import codeBlock from './codeblock.vue';
import axios from 'axios';

export default {

    data() {
        return {
            search: '',
            answer: [],
            headers: {
                Accept: 'application/json',
                'content-type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'}
        }
    },

    components: {
    codeBlock
    },

    setup() {
    },
    methods: {
        async getResponse() {
            const response = await axios.get('http://127.0.0.1:8000/api/getBlocks', {headers: this.headers, withCredentials: true})
            this.answer = response.data["strings"]
        },
    },
    beforeMount() {
            this.getResponse()

        }
}

</script>