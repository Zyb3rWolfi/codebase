<template>
    <div class="">
        <div class="container h-auto max-h-56 p-6 bg-white border border-gray-200 rounded-t-md  shadow dark:bg-gray-800 dark:border-gray-700 max-w-4xl">
        <a href="#">
            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ props.search["strings"] }}</h5>
        </a>
        <div class=" relative">
            <highlightjs :code="codeResult" autodetect class=" "/>
        </div>
          
        </div>
    <ul class="flex flex-wrap dark:bg-gray-800 dark:border-gray-700 border-b border-l border-r p-2 text-gray-400 font-semibold gap-5">
        <li class="mr-2">
            <button class="dark:hover:bg-gray-700 dark:hover:text-gray-300">Modify</button>
        </li>
        <li class="dark:hover:bg-gray-700 dark:hover:text-gray-300">
            <button class="dark:hover:bg-gray-700 dark:hover:text-gray-300">Delete</button>
        </li>
    </ul>
    </div>

</template>

<script setup>
import { ref } from 'vue'
const code = ref('This is code')
import axios from 'axios';
const props = defineProps(['search'])

var codeResult = props.search["content"]

</script>