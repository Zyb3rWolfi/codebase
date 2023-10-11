<script setup>
  import { useRouter } from 'vue-router';
  import { store } from '../Stores/store.js';
  import { ref } from 'vue';
  import MarkdownIt from 'markdown-it'
  import codes from 'highlight.js/lib/common';
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

</script>

<template>

  <div style="background-color: #161616;" class="container grid grid-rows-3">
    <p class=" text-2xl mt-2 font-semibold">{{props.search["strings"]}}</p>
    
    <div class="h-24 text-left">
        <highlightjs :code="codess" autodetect/>     
    </div>
  </div>

</template>