<script setup>
  import { useRouter } from 'vue-router';
  import { onMounted, ref } from 'vue';
  import MarkdownIt from 'markdown-it'
  const markdown = new MarkdownIt()
  const router = useRouter()
  const props = defineProps(['search'])
  import simpleEditor from 'simple-code-editor'
  import { initFlowbite } from 'flowbite';
  import modal from './modal.vue'


  const codess = props.search["content"]
  const title = props.search["strings"]
  const description = props.search["description"]
  
  function Manage() {
    router.push("/Login")
  }

  function Search() {
    router.push("/")
  }

  onMounted(() => {
    initFlowbite()
  })


</script>

<template>

<a class="block max-w-sm p-6 shadow-2xl shadow-black rounded-2xl" style="background-color: #23272f;">
  <p id="resultTitle" class=" text-2xl mt-2 font-semibold row-start-1 mb-3">{{props.search["strings"]}}</p>
  <simpleEditor height="170px" font-size="15px" :autofocus="true" v-model="codess" :read-only="true" width="100%"/>
  <button class=" mt-5" :data-modal-target="title" :data-modal-toggle="title">Inspect</button>
</a>
<modal :id="title" tabindex="-1" aria-hidden="true" :code="codess" :title="title" :description="description"/>



</template>