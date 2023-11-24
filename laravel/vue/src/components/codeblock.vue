<template>
    <div id="block" v-if="deleted == false" class="border-white codeblock-container">
        <div class="w-auto mx-auto max-w-sm codeblock">
            <div v-bind:class="{ expandText : expandIf }" class="codeblock-text mt-10">
                <h5 id="title" class="text-xl font-semibold tracking-tight text-white codeblock-title">{{ title }}</h5>
                <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                <p class="mb-5 text-sm max-w-md"> {{ tempDescription }} <button class="bg-transparent" v-if="descriptionLength > 40" @click="expandManager">...</button> </p>    
            </div>
            <div>
                <CodeEditor v-if="showModal" lang-list-height="200px" :languages="[[currentLanguage]]" height="200px" max-height="200px" max-width="100%" font-size="15px" :read-only="true" v-model="codeResult"/>
                
                <div v-if="!showModal" class="text-center mx-auto my-auto">
                    <div role="status">
                        <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            
            </div>
        </div>
    <ul class="justify-center flex flex-wrap p-6 text-gray-400 font-semibold gap-5 codeblock-buttons">
        <li class="mr-2">
            <button :data-modal-target="codeResult" :data-modal-toggle="codeResult" class="bg-transparent hover:bg-gray-700 hover:text-gray-300 ">Modify</button>
        </li>
        <li class="hover:bg-gray-700 hover:text-gray-300">
            <button @click="removeBlock()" class="hover:bg-gray-700 hover:text-gray-30 bg-transparent">Delete</button>
        </li>
    </ul>
    </div>

    <div :id="codeResult" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-5xl max-h-full">
            <!-- Modal content -->
            <div class="relative rounded-lg shadow bg-slate-950">
                <button :data-modal-hide="codeResult" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparentrounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-white">Modify This Code Block</h3>
                    <form class="space-y-6" action="#">
                        <div>
                            <label for="title" class="block mb-2 text-sm font-medium text-white">Code Block Title</label>
                            <input v-model="title" type="text" name="title" id="title" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white" placeholder="Center a DIV" required>
                        </div>
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-white">Code Block Description</label>
                            <input v-model="description" type="text" name="description" id="description" class=" border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white" placeholder="Center a DIV" required>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-white">Code</label>
                            <CodeEditor lang-list-height="200px" font-size="15px" v-model="codeResult" width="100%" :header="true" :languages="languages"  @lang="getLanguage"/>
                        </div>
                        <button :data-modal-hide="codeResult" @click="modifyBlock()" type="button" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Modify</button>
                    </form>
                </div>
            </div> 
            </div>
        </div>
</template>

<script setup>
// Imports
import { onMounted, ref, computed } from 'vue'
import CodeEditor from "simple-code-editor";
import axios from 'axios';
import { initFlowbite } from 'flowbite'
import { useStore } from 'vuex';

const props = defineProps(['search']) // This is props
const apiUrl = import.meta.env.VITE_API_BASE_URL // Api Url from .evn file
const store = useStore() // Vuex Store
var tempLang = ref(props.search["language"]) // Temporary language !!:: DO NOT DELETE ::!! idk what this does but it breaks everything if you do
const currentLanguage = computed(() => tempLang.value) // Current language using computed

var showModal = ref(true) // Show modal

// Languages for the code editor
var languages = [["python"], ['cpp'], ['html'], ['js'], ['css'], ['java'], ['php'], ['csharp'], ['c'], ['ruby'], ['go'], ['kotlin'], ['swift'], ['sql'], ['rust'], ['typescript'], ['bash'], ['perl'], ['lua'], ['powershell']]
var tempLanguages = [[props.search["language"]]] // Temporary languages used for ordering the code editor languages
var selectedLanguage = ref(props.search["language"]) // Current language used to determin which language should be defualted to when modifying a code block

// there was this variable language = tempLanguages but dunno what it does so deleted it <--- this was a mistake it broke stuff :(

// Variables for the code editor
var codeResult = ref(props.search["code"])
var title = ref(props.search["title"])
var description = ref(props.search["description"])
var deleted = ref(false)

// Original code and title
const originalCode = ref(props.search["code"])
const originalTitle = ref(props.search["title"])
const originalDescription = ref(props.search["description"])
const expandIf = ref(false)
const descriptionLength = ref(props.search["description"].length)
var shortDescription = ref()
var tempDescription = ref(props.search["description"])

// Header for API
const headers = {
    Accept: 'application/json',
    'content-type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest'
}

// Data for the API
var blockData = {
    code: '',
    description: '',
}
// Changed data for the API
var changedData = {
    code: '',
    title: '',
    description: '',
    newLanguage: '',
    newCode: '',
    newDescription: '',
    newTitle: '',
}

function orderLanguages() {

    //simple linear search to put all but the slected language in the array 
    for (var i = 0; i < languages.length; i++) {
        if (languages[i][0] != selectedLanguage.value) {
            tempLanguages.push(languages[i])
        }
    }
    languages = tempLanguages
}

function setDescription() {
    if (descriptionLength.value > 40) {
        shortDescription.value = props.search["description"].substring(0, 40)
        tempDescription.value = shortDescription.value
    }
    else {
        shortDescription.value = props.search["description"]
    }
}
// On mounted
// Currently initializing flowbite
onMounted(() => {
    initFlowbite()
    
    setDescription()
})

function expandManager() {
    if (expandIf.value == true) {
        expandIf.value = false
        tempDescription.value = shortDescription.value
    }
    else {
        expandIf.value = true
        tempDescription.value = description
    }
}


//Antons tole me to put this in onMouned but that broke everything so fuck that guy 
orderLanguages()

function getLanguage(lang) {
    changedData.newLanguage = lang
}

// Calls API to remove block
async function removeBlock() {
    blockData.code = codeResult
    blockData.title = props.search["title"]
    try {
        await axios.post(apiUrl + '/api/deleteBlock', blockData, {headers: headers, withCredentials: true}).then(function(response) {
            deleted.value = true
            store.commit('ADD_TOAST', {
                title: 'Block Deleted',
                type: 'success',
                id: Math.floor(Math.random() * 50),
                duration: 5000
            })
    })
    } 
    catch (e) {
        console.log(e)
    }

}

// Calls API to modify block
async function modifyBlock() {
    console.log("pressing")
    try {
        showModal.value = false
        changedData.code = originalCode.value
        changedData.description = originalTitle.value
        changedData.newCode = codeResult.value
        changedData.newDescription = title.value

    showModal.value = false
    changedData.code = originalCode.value
    changedData.title = originalTitle.value

    changedData.newCode = codeResult.value
    changedData.newTitle = title.value
    changedData.newDescription = description.value

        const response = await axios.post(apiUrl + '/api/updateBlock', changedData, {headers: headers, withCredentials: true})
        
        tempLang.value = changedData.newLanguage
        showModal.value = true
    }   
    catch (e) {
        console.log(e)
    }

}

function change() {
    console.log("Expanding")
    expandIf.value = true
    console.log(expandIf)
}

</script>
