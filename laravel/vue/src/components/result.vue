<script setup>
  import { useRouter } from 'vue-router';
  import { store } from '../Stores/store.js';
  import { ref } from 'vue';
  import MarkdownIt from 'markdown-it'
  const markdown = new MarkdownIt()
  const router = useRouter()
  const props = defineProps(['search'])

  var example = markdown.render("" + props.search["content"])
  var codess = props.search["content"]
  console.log(codess)

  function Manage() {
    router.push("/Login")
  }

  function Search() {
    router.push("/")
  }

  async function copyCode() {
    await navigator.clipboard.writeText(codess);
    alert("Copied to clipboard!");
  }

</script>

<template>

  <div style="background-color: #161616;" class="block grid-rows-3">
    <p class=" text-2xl mt-2 font-semibold row-start-1">{{props.search["strings"]}}</p>
    
    <div class="h-24 text-left row-start-2 flex items-center justify-center ">
        <highlightjs :code="codess" autodetect class="h-20 w-96"/>     
    </div>
    <button type="button" @click="copyCode()" class=" mt-24 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-md text-sm w-20 h-10 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Copy</button>
  </div>

</template>