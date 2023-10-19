<script setup>
  import { useRouter } from 'vue-router';
  import { ref } from 'vue';
  import MarkdownIt from 'markdown-it'
  const markdown = new MarkdownIt()
  const router = useRouter()
  const props = defineProps(['search'])
  import simpleEditor from 'simple-code-editor'

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

  <div style="background-color: #161616;" class="block grid-rows-3">
    <p class=" text-2xl mt-2 font-semibold row-start-1">{{props.search["strings"]}}</p>
    
    <div class="h-24 text-left row-start-2 flex items-center justify-center ">   
        <simpleEditor v-model="codess" :read-only="true" width="80%"/>
    </div>
  </div>

</template>