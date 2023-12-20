<template>
    <div id="block" v-if="deleted == false" class="border-white codeblock-container">
        <div class="w-auto mx-auto max-w-sm codeblock">
            <div v-bind:class="{ expandText : expandIf }" class="codeblock-text mt-10">
                <div class="h-12 items-end container align-bottom grid">
                    <h5 id="title" class=" text-left align-bottom text-md font-semibold tracking-tight text-white codeblock-title">{{ title }}</h5>
                </div>
                <hr class="h-px my-1 border-0 bg-gray-700">
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
            <button :data-modal-target="codeResult" :data-modal-toggle="codeResult" class=" bg-transparent hover:text-gray-300 ">
                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                    <path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"/>
                    <path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"/>
                </svg>
            </button>
        </li>
        <li class="">
            <button :data-modal-target="title + 'removeConfirm'" :data-modal-toggle="title + 'removeConfirm'" class=" bg-transparent">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                </svg>
  
            </button>
        </li>
        <li class="">
            <button @click="getShareToken()" class=" bg-transparent">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M16.922 11.76a1.56 1.56 0 0 0-.551-1.208L11.264 6.3a1.35 1.35 0 0 0-1.473-.2 1.542 1.542 0 0 0-.872 1.427v1.221a6.922 6.922 0 0 0-6 7.134v1.33A1.225 1.225 0 0 0 4.143 18.5a1.187 1.187 0 0 0 1.08-.73 4.72 4.72 0 0 1 3.7-2.868v1.085a1.546 1.546 0 0 0 .872 1.428 1.355 1.355 0 0 0 1.472-.2l5.108-4.25a1.56 1.56 0 0 0 .547-1.206Z"/>
                    <path d="m21.428 10.205-5.517-4.949a1 1 0 1 0-1.336 1.488l5.517 5.014-5.611 5.088a1 1 0 1 0 1.344 1.482l5.611-5.088a2.049 2.049 0 0 0-.008-3.035Z"/>
                </svg>    
            </button>
        </li>
    </ul>
    </div>

    <!-- This is the modify modal -->
    <div :id="codeResult" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-5xl max-h-full">
            <div class="relative rounded-lg shadow bg-gray-700">
                <button :data-modal-hide="codeResult" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparentrounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 id="title" class="mb-4 text-xl font-medium text-white">Modify This Code Block</h3>
                    <form class="space-y-6" action="#">
                        <div>
                            <label id="sub" for="title" class="block mb-2 text-sm font-medium text-white">Code Block Title</label>
                            <input v-model="title" maxlength="55" type="text" name="title" id="title" class="border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white" placeholder="Center a DIV" required>
                            <p class=" text-xs mt-3 text-gray-400">characters left: {{55 - title.length}}</p>

                        </div>
                        <div>
                            <label id="sub" for="description" class="block mb-2 text-sm font-medium text-white">Code Block Description</label>
                            <textarea  v-model="description" maxlength="255" type="text" name="description" id="description" class=" border text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white" placeholder="Center a DIV" required/>
                            <p class=" text-xs mt-3 text-gray-400">characters left {{255 - description.length}}</p>

                        </div>
                        <div>
                            <label id="sub" for="password" class="block mb-2 text-sm font-medium text-white">Code</label>
                            <CodeEditor lang-list-height="200px" font-size="15px" v-model="codeResult" height="400px" width="100%" :header="true" :languages="languages"  @lang="getLanguage"/>
                        </div>
                        <button :data-modal-hide="codeResult" @click="modifyBlock()" type="button" class="w-full text-white  focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Modify</button>
                    </form>
                </div>
            </div> 
            </div>
        </div>

        <!--This modal shows a confirmation screen-->
        <div :id="title + 'removeConfirm'" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative  rounded-lg shadow bg-gray-700">
                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white" :data-modal-hide="title + 'removeConfirm'">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this Code Block?</h3>
                        <button @click="removeBlock()" :data-modal-hide="title + 'removeConfirm'" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none  focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                            Yes, I'm sure
                        </button>
                        <button :data-modal-hide="title + 'removeConfirm'" type="button" class=" focus:ring-4 focus:outline-none  rounded-lg border  text-sm font-medium px-5 py-2.5  focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white">No, cancel</button>
                    </div>
                </div>
            </div>
        </div>

</template>

<script setup>
// Imports
import { onMounted, ref, computed, onBeforeMount } from 'vue'
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

// Variables for the code editor
var codeResult = ref(props.search["code"])
var title = ref(props.search["title"])
var description = ref(props.search["description"])
var deleted = ref(false)
var shareToken = ref(props.search["shareToken"])
var id = ref(props.search["id"])
var shareLink = ref("")
var loadLink = ref(false)
var titleCharacters = ref(50)
var descriptionCharacters = ref(255)
const updateLink = computed(() => shareLink)
var payload = {
        code: codeResult.value,
        title: title.value,
        description: description.value,
        language: selectedLanguage.value,
        id: id.value,
    }


var header = {
                Accept: 'application/json',
                'content-type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
        }


async function getShareToken() {
        if (shareToken.value == null) {
            const response = await axios.post(apiUrl + '/api/createShareToken', payload, {headers: header, withCredentials: true});
            shareToken.value = response.data["token"]
            shareLink.value = "codebranch.me/share/" + response.data["token"]
            loadLink.value = true
            return
        }
        shareLink = "https://codebranch.me/share/" + shareToken.value
        loadLink.value = true
        navigator.clipboard.writeText(shareLink)
        store.commit('ADD_TOAST', {
                title: 'Share Link Copied',
                type: 'success',
                id: Math.floor(Math.random() * 50),
                duration: 5000
            })
}


// Original code and title
const originalCode = ref(props.search["code"])
const originalTitle = ref(props.search["title"])
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
    id: ref(props.search["id"]).value,
    description: '',
    newLanguage: '',
    newCode: '',
    newDescription: '',
    newTitle: '',
}

var languageStore = store.state.filterLanguages

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

    descriptionCharacters = title.length;
    titleCharacters = description.length;
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
        tempDescription.value = description.value
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
        await axios.post(apiUrl + '/api/deleteBlock', blockData, {headers: headers, withCredentials: true}).then(async function(response) {
            deleted.value = true
            store.commit('ADD_TOAST', {
                title: 'Block Deleted',
                type: 'success',
                id: Math.floor(Math.random() * 50),
                duration: 5000
            })
            
        })

        const blocks = await axios.post(apiUrl + '/api/getBlocks', [], {headers : headers, withCredentials: true})
        // FILTERING LOGIC WHEN DELETING A BLOCK
        // We loop through the languageStore and the blocksData from REQUEST, if the language exists in the request we push
        var tempSet = new Set()
        for (var i = 0; i < blocks.data["strings"].length; i++) {
            tempSet.add(blocks.data["strings"][i]["language"])
        }
        store.dispatch('setFilterLanguages', Array.from(tempSet))
        // ------
    } 
    catch (e) {
        console.log(e)
    }

}

// Calls API to modify block
async function modifyBlock() {
    try {
        showModal.value = false
        changedData.code = originalCode.value
        changedData.description = originalTitle.value
        changedData.newCode = codeResult.value
        changedData.title = originalTitle.value
        changedData.newTitle = title.value
        changedData.newDescription = description.value

        await axios.post(apiUrl + '/api/updateBlock', changedData, {headers: headers, withCredentials: true})

        shortDescription.value = changedData.newDescription.substring(0, 40) // This sets the short description max 40 characters
        description.value = changedData.newDescription // This sets the whole description when expanded
        tempDescription.value = shortDescription.value // This is the current description that going to be displayed
        descriptionLength.value = changedData.newDescription.length // This is the length of the overall
        
        tempLang.value = changedData.newLanguage
        showModal.value = true

        const blocks = await axios.get(apiUrl + '/api/getBlocks', {headers: headers, withCredentials: true})

        // FILTERING LOGIC WHEN MODIFYING A BLOCK
        var temp = []
        var addLanguage = true
        for (var i = 0; i < languageStore.length; i++) {
            if (changedData.newLanguage == this.store.state.filterLanguages[i]) {
                addLanguage = false
            }
            for (var j = 0; j < blocks.data["strings"].length; j++) {
                if (blocks.data["strings"][j]["language"] == languageStore[i]) {
                    temp.push(blocks.data["strings"][j]["language"])
                    break
                } else {
                    continue
                }
            }
        }

        if (addLanguage) {
            temp.push(changedData.newLanguage)
        }
        store.dispatch('setFilterLanguages', temp)
        // ------
    }   
    catch (e) {
        console.log(e)
    }

}

</script>
