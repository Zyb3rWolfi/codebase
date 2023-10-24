<template>
   <div id="code" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-5xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="px-8 pb-8 py-10 lg:px-20">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">{{ title }}</h3>
                <p class="mb-5">{{ description }}</p>
                <CodeEditor height="600px" :read-only="true" font-size="15px" value="{{ code }}" v-model="code" width="" :header="true" :languages="[['python', 'Python'], ['cpp', 'c++']]" :line-nums="true"/>
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

var code = ref(props.code)
var title = ref(props.title)
var description = ref(props.description)
console.log(props.description)

const originalCode = ref(props.code)
const originalTitle = ref(props.title)

function reloadPage() {
    this.$forceUpdate();
}

</script>