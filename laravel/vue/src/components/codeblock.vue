<template>
    <div class="">
        <div class="container h-auto max-h-56 p-6 bg-white border border-gray-200 rounded-t-md  shadow dark:bg-gray-800 dark:border-gray-700 max-w-4xl">
        <a href="#">
            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ props.search["strings"] }}</h5>
        </a>
        <div class=" relative">
            <CodeEditor :read-only="true" v-model="codeResult" width="100%" :line-nums="true"/>
        </div>
          
        </div>
    <ul class="flex flex-wrap dark:bg-gray-800 dark:border-gray-700 border-b border-l border-r p-2 text-gray-400 font-semibold gap-5">
        <li class="mr-2">
            <button ata-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="dark:hover:bg-gray-700 dark:hover:text-gray-300">Modify</button>
        </li>
        <li class="dark:hover:bg-gray-700 dark:hover:text-gray-300">
            <button @click="removeBlock()" class="dark:hover:bg-gray-700 dark:hover:text-gray-300">Delete</button>
        </li>
    </ul>
    </div>
    <modal :title="codeDescription" :code="codeResult"/>
    
 
</template>

<script setup>
import { onMounted, ref, computed } from 'vue'
import CodeEditor from "simple-code-editor";
import axios from 'axios';
const props = defineProps(['search'])
import { initFlowbite } from 'flowbite'
import Modal from './modal.vue';

onMounted(() => {
    initFlowbite()
})

const prop = ref(props.search)
const codeResult = ref(props.search["content"])
const codeDescription = ref(props.search["strings"])

const headers = {
        Accept: 'application/json',
        'content-type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }

var blockData = {
    code: '',
    description: '',
}

async function removeBlock() {
    blockData.code = codeResult
    blockData.description = props.search["strings"]
    const response = await axios.post('http://127.0.0.1:8000/api/deleteBlock', blockData, {headers: this.headers, withCredentials: true})

}

async function modifyBlock() {

    console.log(changedData)
    const response = await axios.post('http://127.0.0.1:8000/api/updateBlock', changedData, {headers: this.headers, withCredentials: true})
    console.log(response.data)

}


</script>