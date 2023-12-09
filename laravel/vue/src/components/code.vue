<template class="">
    <div class="max-w-screen-xl items-center flex flex-wrap mx-auto justify-between p-3">
        <div>
            <p id="userTitle" class=" text-2xl font-semibold col-start-2">Code Blocks</p>
        </div>
        <div class=" flex justify-end flex-wrap">
            <button id="openCreateModal" class=" text-white bg-blue-700 rounded-lg p-3 justify-self-end text-sm" >CodeBlock + </button>            
            <button data-popover-placement="bottom" data-popover-target="filters" class="ml-5 bg-blue-700 p-2 rounded-lg">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                    <path d="M18.85 1.1A1.99 1.99 0 0 0 17.063 0H2.937a2 2 0 0 0-1.566 3.242L6.99 9.868 7 14a1 1 0 0 0 .4.8l4 3A1 1 0 0 0 13 17l.01-7.134 5.66-6.676a1.99 1.99 0 0 0 .18-2.09Z"/>
                </svg>
            </button>
        </div>
  </div>
  <div id="filters" role="tooltip" class="absolute z-10 invisible inline-block text-sm transition-opacity duration-300 border rounded-lg shadow-sm opacity-0 text-gray-400 border-gray-600 bg-gray-800">
    <div class="px-3 py-2">
        <label id="sub" class=" text-md block font-medium text-white">Languages</label>
        <ul class=" grid ">
            <li v-for="lang in this.filterUpdate">
                <label class="inline-flex items-center mt-3">
                    <input @click="updateFilters" v-model="selectedLanguages.filters" type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" :value="lang">
                    <span class="ml-2 text-gray-300">{{ lang }}</span>
                </label>
            </li>
        </ul>
    </div>
    <div data-popper-arrow></div>
  </div>

    <div v-if="!gotBlocks" class="text-center">
        <div role="status">
            <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="lg:flex-cols-4 w-auto mt-3 flex gap-5 flex-wrap flex-row sm:flex-cols-1 md:grid-cols-2 justify-evenly">
        <codeBlock v-for="ans in answer" :search="ans" :key="ans"/>
        <div v-if="answer.length == 0 && gotBlocks" class="text-center my-48">
            <p id="title" class="text-2xl font-semibold col-start-2">/ 404 No Codeblocks Found /</p>
            <p class=" mt-5 text-neutral-300 text-sm">not an error btw</p>
        </div>
    </div>
<!-- Main modal -->
<div id="authentication-modal" class="fixed top-0 left-0 right-0 z-30 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-5xl max-h-full">
        <!-- Modal content -->
        <div class="relative rounded-lg shadow bg-gray-700">
            <button id="closeButton" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparentrounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white" data-modal-hide="authentication-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 id="title" class="mb-4 text-xl font-medium text-white">Create a Code Block</h3>
                <form class="space-y-6" action="#">
                    <div>
                        <label id="sub" for="title" class="block mb-2 text-sm font-medium text-white">Code Block Title</label>
                        <input @input="checkTitleLength" maxlength="50" v-model="sendData.title" type="text" name="title" id="title" class=" border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white" placeholder="Center a DIV" required>
                        <p class=" text-xs mt-3 text-gray-400">characters left: {{this.titleCharacters}}</p>
                    </div>

                    <div>
                        <label id="sub" for="description" class="block mb-2 text-sm font-medium text-white">Code Block Description</label>
                        <textarea @input="checkDescriptionLength" maxlength="255" v-model="sendData.description" type="text" name="description" id="description" class="borde text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white" placeholder="" required />
                        <p class=" text-xs mt-3 text-gray-400">characters left {{this.descriptionCharacters}}</p>
                    </div>

                    <div class="container">
                        <label id="sub" for="password" class="block mb-2 text-sm font-medium text-white">Code</label>
                        <CodeEditor lang-list-height="200px" max-height="800px" height="400px" v-model="sendData.code" font-size="15px" width="100%" :header="true" :languages="languages" @lang="getLanguage"/>
                    </div>
                    <button id="submitModal" @click="sendBlock" type="button" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>

</template>

<script>
import CodeEditor from "simple-code-editor";
import hljs from 'highlight.js';
import { onBeforeMount, onMounted, computed, queuePostFlushCb  } from 'vue';
import codeBlock from './codeblock.vue';
import axios from 'axios';
import { initFlowbite } from 'flowbite'
import { useStore } from 'vuex';
const apiUrl = import.meta.env.VITE_API_BASE_URL

let modal = null

export default {
    async mounted() {
    },

    data() {
        return {
            languages: [['python'], ['cpp'], ['html'], ['js'], ['css'], ['java'], ['php'], ['csharp'], ['c'], ['ruby'], ['go'], ['kotlin'], ['swift'], ['sql'], ['rust'], ['typescript'], ['bash'], ['perl'], ['lua'], ['powershell']],
            search: '',
            answer: [],
            headers: {
                Accept: 'application/json',
                'content-type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'},
            
            sendData: {
                code: '',
                title: '',
                language: '',
                description: '',
            },
            gotBlocks: false,
            checked: false,
            storedLanguages: [],
            selectedLanguages: {
                filters: []
            },
            reloading: false,
            languageSet: new Set(),
            titleCharacters: 50,
            descriptionCharacters: 255,
            
        }
    },
    components: {
        codeBlock,
        CodeEditor,
    },

    setup() {
        onMounted(() => {
            initFlowbite();

            const modalTarget = document.getElementById('authentication-modal')
            const modalButton = document.getElementById('openCreateModal')
            const closeModal = document.getElementById('closeButton')

            const settings = {
                closable: false,
                backdropClasses: 'bg-gray-900/50 bg-gray-900/80 fixed inset-0 z-10',
                backdrop: 'dynamic',
            }
            const isntanceSettings = {
                id: 'modalEl',
                override: true
            }

            if (modalTarget) {
                modal = new Modal(modalTarget, settings, isntanceSettings)
                modalButton.addEventListener('click', () => modal.show())
                closeModal.addEventListener('click', () => modal.hide())
            }

        })
        const store = useStore()
        var codeRefresh = computed(() => store.state.codeRefresh)
        return { store, codeRefresh }
    },
    mounted() {
    },
    computed: {
        filterUpdate() {
            this.getResponse()
            return this.store.state.filterLanguages
        }
    },
    watch: {
        codeRefresh() {
            this.getResponse()
        }
    },
    methods: {
        checkTitleLength() {
            this.titleCharacters = 50 - this.sendData.title.length
        },
        checkDescriptionLength() {
            this.descriptionCharacters = 255 - this.sendData.description.length
        },
        // FILTERING LOGIC WHEN SELECTING A LANGUAGE
        async updateFilters() {
            gotBlocks = false

            const response = await axios.get(apiUrl + '/api/getBlocks', {headers: this.headers, withCredentials: true})
            this.answer = response.data["strings"]
            
            this.store.dispatch('setFilterLanguages', Array.from(this.languageSet))
            this.gotBlocks = true
        },
        getLanguage(lang) {
            this.sendData.language = lang
        },
        async getResponse() {
            try {
                const response = await axios.post(apiUrl + '/api/getBlocks/', this.selectedLanguages, {headers: this.headers, withCredentials: true})
                this.answer = response.data["strings"]
                
                // FILTERING LOGIC WHEN GETTING THE BLOCKS
                if(!this.gotBlocks) {
                    for (var i = 0; i < response.data["strings"].length; i++) {
                        this.languageSet.add(response.data["strings"][i]["language"])
                    }
                    this.store.dispatch('setFilterLanguages', Array.from(this.languageSet))
                }
                this.gotBlocks = true
            }
            catch (e) {
                console.log(e)
            }
            },
        
        async sendBlock() {
            
            if (this.sendData.code == '' || this.sendData.title == '' || this.sendData.language == '' || this.sendData.description == '') {
                this.store.commit('ADD_TOAST', {
                    title: 'Please fill out all fields',
                    type: 'warning',
                    id: Math.floor(Math.random() * 50),
                    duration: 5000
                })
                return
            }
            
            await axios.post(apiUrl + '/api/addBlock', this.sendData, {headers: this.headers, withCredentials: true})

            // FILTERING LOGIC WHEN ADDING A NEW BLOCK

            this.languageSet.add(this.sendData.language)
            console.log("Saving to dataset")

            
            this.store.dispatch('setFilterLanguages', Array.from(this.languageSet))
            

            this.store.commit('ADD_TOAST', {
                title: 'Block Created',
                type: 'success',
                id: Math.floor(Math.random() * 50),
                duration: 5000
            })
            this.checked = true
            modal.hide()
            this.sendData.code = ''
            this.sendData.title = ''
            this.sendData.description = ''
            return this.getResponse()
        },
    },
    beforeMount() {
            this.getResponse()
        },
}

</script>