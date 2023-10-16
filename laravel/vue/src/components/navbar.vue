<script setup>
  import { useRouter } from 'vue-router';
  import { ref } from 'vue'
  import { useStore } from 'vuex';
  import {computed} from 'vue'
  import axios from 'axios'
  const store = useStore()

  const auth = computed(() => store.state.auth)
  console.log(auth)

  const router = useRouter()

  function Manage() {
    if (auth.value) {
      router.push("/user/" + store.state.id)
    } else {
      router.push("/Login")
    }
  }

  function Search() {
    router.push("/")
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
<nav class="">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="https://flowbite.com/" class="flex items-center">
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">CodeBase</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0">
        <li>
          <a @click="Search()" class=" cursor-pointer block py-2 pl-3 pr-4 text-white rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Search</a>
        </li>
        <li>
          <a @click="Manage()" class="cursor-pointer block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Manage</a>
        </li>
        <li>
          <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About</a>
        </li>
        <li v-if="auth">
          <button @click="logOut()" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Sign Out</button>
        </li>
      </ul>
    </div>
    
  </div>
</nav>
</template>