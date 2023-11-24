<script setup>
  import { computed, onMounted } from 'vue';
  const props = defineProps(['search'])
  import simpleEditor from 'simple-code-editor'
  import { initFlowbite } from 'flowbite';
  import modal from './modal.vue'


  var codess = props.search["code"]
  var title = props.search["title"]
  var language = computed(() =>  props.search["language"])

  onMounted(() => { // runs after the component is mounted
    initFlowbite()
    
    // creates the modal and button variables
    const $target = document.getElementById(title)
    const $inspectOpen = document.getElementById(title + "_button")
    const $inspectClose = document.getElementById(title + "_button_close")

    // sets the options for the modal
    const settings = {
      placement: 'bottom-right',
      backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
      closable: true,
    }

    if ($target) {

      const modal = new Modal($target, settings) // creates the modal variable

      // adds event listeners to the buttons for when they are pressed
      $inspectOpen.addEventListener('click', () => modal.toggle())
      $inspectClose.addEventListener('click', () => modal.toggle())
  }

  })

</script>

<template :id="title">
<a class="container p-6 rounded-2xl">
  <p id="resultTitle" class="text-2xl mt-2 font-semibold row-start-1 mb-3">{{props.search["title"]}}</p>
  <p class="mb-5 text-sm">{{ props.search["description"] }}</p>
  <simpleEditor :id="codess" height="300px" :languages="[[language]]" font-size="15px" :autofocus="true" v-model="props.search['code']" :read-only="true" width="100%"/>
  <button :id="title + '_button'" class=" mt-5 bg-transparent text-white">Inspect</button>
</a>

<modal :key="props.search.id" :id="props.search['title']" tabindex="-1" aria-hidden="true" :code="props.search['code']" :title="props.search['title']" :description="props.search['description']" :language="[props.search['language']]"/>

</template>