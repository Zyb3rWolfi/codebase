<template>
    <div v-if="deleted == false" class=" shadow-2xl shadow-black p-10 rounded-2xl border-white" style="background-color: #23272f;">
        <div class="container h-auto p-6border-gray-200 rounded-t-md max-w-4xl">
        <a href="#">
            <h5 class=" text-center mb-4 text-xl font-semibold tracking-tight text-gray-900 dark:text-white"> {{ title }}</h5>
        </a>
        <div class="">
            <CodeEditor height="200px" max-height="200px" font-size="15px" :read-only="true" v-model="codeResult" width="100%"/>
        </div>
          
        </div>
    <ul class=" justify-center flex flex-wrap p-2 text-gray-400 font-semibold gap-5">
        <li class="mr-2">
            <button :data-modal-target="codeResult" :data-modal-toggle="codeResult" class="dark:hover:bg-gray-700 dark:hover:text-gray-300">Modify</button>
        </li>
        <li class="dark:hover:bg-gray-700 dark:hover:text-gray-300">
            <button @click="removeBlock()" class="dark:hover:bg-gray-700 dark:hover:text-gray-300">Delete</button>
        </li>
    </ul>
    </div>

    <div :id="codeResult" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-5xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-slate-950">
                <button :data-modal-hide="codeResult" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Modify This Code Block</h3>
                    <form class="space-y-6" action="#">
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code Block Description</label>
                            <input v-model="title" type="text" name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Center a DIV" required>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code</label>
                            <CodeEditor font-size="15px" v-model="codeResult" width="100%" :header="true" :languages="[['python', 'Python'], ['cpp', 'c++'], ['html', 'HTML'], ['js', 'JavaScript']]" :line-nums="true"/>
                        </div>
                        <button :data-modal-hide="codeResult" @click="modifyBlock()" type="button" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Modify</button>
                    </form>
                </div>
            </div> 
            </div>
        </div>
</template>

<script setup>
import { onMounted, ref, computed, getCurrentInstance } from 'vue'
import CodeEditor from "simple-code-editor";
import axios from 'axios';
const props = defineProps(['search'])
import { initFlowbite } from 'flowbite'
import Modal from './modal.vue';
import { useStore } from 'vuex';

const intance = getCurrentInstance();
const store = useStore()

onMounted(() => {
    initFlowbite()
})

const prop = ref(props.search)

var codeResult = ref(props.search["code"])
var title = ref(props.search["title"])
var deleted = ref(false)

const originalCode = ref(props.search["code"])
const originalTitle = ref(props.search["title"])

const headers = {
        Accept: 'application/json',
        'content-type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }

var blockData = {
    code: '',
    description: '',
}

var changedData = {
    code: '',
    description: '',

    newCode: '',
    newDescription: '',
}

async function removeBlock() {
    blockData.code = codeResult
    blockData.description = props.search["strings"]
    const response = await axios.post('http://127.0.0.1:8000/api/deleteBlock', blockData, {headers: this.headers, withCredentials: true})
    deleted.value = true
    store.commit('ADD_TOAST', {
        title: 'Block Deleted',
        type: 'success',
        id: Math.floor(Math.random() * 50),
        duration: 5000
    })

    console.log(store.state.toasts)


}

async function modifyBlock() {

    changedData.code = originalCode.value
    changedData.description = originalTitle.value
    changedData.newCode = codeResult.value
    changedData.newDescription = title.value

    console.log(changedData)
    const response = await axios.post('http://127.0.0.1:8000/api/updateBlock', changedData, {headers: this.headers, withCredentials: true})
    console.log(response.data)
    intance.proxy.$forceUpdate();

}


</script>