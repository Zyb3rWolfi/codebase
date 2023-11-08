<script setup>
  import { RouterLink, useRouter } from 'vue-router';
  import { ref, onMounted } from 'vue'
  import { useStore } from 'vuex';
  import {computed} from 'vue'
  import axios from 'axios'
  import { initFlowbite } from 'flowbite'
  import login from "../views/loginRegisterView.vue"
  
  const store = useStore()

  const auth = computed(() => store.state.auth)

  var selected = ref("search")
  const router = useRouter()

  onMounted(() => {
    initFlowbite()
  })

  function Manage() {
    if (auth.value) {
      router.push("/user/" + store.state.id + "/code")
    } else {
      router.push("/Login")
    }

    selected = "manage"
  }

  function logIn() {
    router.push("/Login")
  }

  function Search() {
    router.push("/")
    selected = "search"
  }

  async function logOut() {

    const headers = {
      Accept: 'application/json',
      'content-type': 'application/json',}
    const response = await axios.post('http://127.0.0.1:8000/api/logout', {headers: headers}, {withCredentials: true})
    console.log(response.data)
    await store.dispatch('setAuthentication', false)
    await store.dispatch('setUserID', -1)
    router.push("/")
  }

</script>

<template>
<nav class=" shadow-md dark:border-neutral-500 border-b">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-3">
    <a class="flex items-center">
        <span id="logo" class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">CodeBase</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto my-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 text-sm my-auto border rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0">
        <li>
          <router-link active-class="active" :to="'/'" class=" cursor-pointer block py-2 pl-3 pr-4 text-white rounded md:bg-transparent md:p-0 dark:text-neutral-500">// Search</router-link>
        </li>
        
        <li v-if="auth">
          <router-link active-class="active" :to="'/user/' + store.state.id + '/code'" class="cursor-pointer block py-2 pl-3 pr-4 text-white rounded md:bg-transparent md:p-0 dark:text-neutral-500">// Manage</router-link>
        </li>
        <li>
          <router-link active-class="active" :to="'/about'" class="cursor-pointer block py-2 pl-3 pr-4 text-white rounded md:bg-transparent md:p-0 dark:text-neutral-500">// About</router-link>
        </li>
        
      </ul>
    </div>
    <button v-if="auth" @click="logOut()" type="button" class="text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 border dark:hover:bg-gray-800 focus:outline-none dark:focus:ring-blue-800">Sign Out</button>
    <button v-else="!auth" data-modal-toggle="loginView" data-modal-target="loginView" type="button" class="text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 border dark:hover:bg-gray-800">Sign In</button>
  </div>
</nav>
<login />
</template>