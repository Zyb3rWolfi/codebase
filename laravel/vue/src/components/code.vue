<template class="">
    <div class="grid lg:grid-cols-7 md:grid-cols-6 sm:grid-cols-2">
        <p class=" text-2xl font-semibold col-start-2">Code Blocks</p>
    </div>
    <div class="lg:grid-cols-4 w-auto mt-10 gap-5 grid sm:grid-cols-1 md:grid-cols-2 lg:ml-20 lg:mr-20 sm:ml-5 sm:mr-5">
        <codeBlock v-for="ans in answer" :search="ans" :key="ans"/>
        <div class="my-auto mt-20 mx-auto">
            <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" type="button" class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
            <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
            </svg>
            </button>  
        </div>
    </div>
<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Create a Code Block</h3>
                <form class="space-y-6" action="#">
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code Block Description</label>
                        <input v-model="sendData.description" type="text" name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Center a DIV" required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code</label>
                        <CodeEditor v-model="sendData.code" font-size="15px" width="100%" :header="true" :languages="[['python', 'Python'], ['cpp', 'c++']]" :line-nums="true"/>
                    </div>
                    <button @click="sendBlock()" type="button" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
                </form>
            </div>
        </div>
    </div>
</div> 
</template>

<script>
import CodeEditor from "simple-code-editor";
import hljs from 'highlight.js';
import { onBeforeMount, onMounted, computed  } from 'vue';
import codeBlock from './codeblock.vue';
import axios from 'axios';
import { initFlowbite } from 'flowbite'
import { useStore } from 'vuex';

export default {
    async mounted() {
    },

    data() {
        return {
            search: '',
            answer: [],
            headers: {
                Accept: 'application/json',
                'content-type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'},
            
            sendData: {
                code: '',
                description: '',
            },
            
        }
    },
    components: {
        codeBlock,
        CodeEditor,
    },

    setup() {
        onMounted(() => {
            initFlowbite();
        })
        const store = useStore()
        var codeRefresh = computed(() => store.state.codeRefresh)
        return { store, codeRefresh }
    },
    mounted() {
    },
    watch: {
        codeRefresh() {
            console.log("refreshing")
            this.getResponse()
        }
    },
    methods: {
        async getResponse() {
            const response = await axios.get('http://127.0.0.1:8000/api/getBlocks', {headers: this.headers, withCredentials: true})
            this.answer = response.data["strings"]
            },
        
        async sendBlock() {
            const response = await axios.post('http://127.0.0.1:8000/api/addBlock', this.sendData, {headers: this.headers, withCredentials: true})
            console.log(response.data)
            return this.getResponse()
        },
    },
    beforeMount() {
            this.getResponse()
        },
}

</script>