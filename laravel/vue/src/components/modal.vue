<template>
   <div :id="props.code" tabindex="-1" aria-hidden="true" class="fixed mx-auto top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative mx-auto w-full max-w-6xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button :id="props.title + '_button_close'" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-8 pb-8 py-10 lg:px-20">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">{{ props.title }}</h3>
                <p class="mb-5">{{ props.description }}</p>
                <CodeEditor :value="code" width="100%" height="600px" :read-only="true" />
            </div>
            
        </div> 
        </div>
        </div>
</template>

<script setup>

import { onMounted, ref, computed } from 'vue'
const props = defineProps(['title', 'description', 'code'])
import CodeEditor from "simple-code-editor";
import hljs from 'highlight.js';

var thisCode;

function resetValue() {

}

</script>