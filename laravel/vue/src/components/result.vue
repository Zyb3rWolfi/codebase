<script setup>
  import { useRouter } from 'vue-router';
  import { ref } from 'vue';
  import MarkdownIt from 'markdown-it'
  const markdown = new MarkdownIt()
  const router = useRouter()
  const props = defineProps(['search'])
  import simpleEditor from 'simple-code-editor'

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

<a href="#" class="block max-w-sm p-6 shadow-2xl">
  <p class=" text-2xl mt-2 font-semibold row-start-1 mb-3">{{props.search["strings"]}}</p>
  <simpleEditor v-model="codess" :read-only="true" width="100%"/>
</a>



</template>