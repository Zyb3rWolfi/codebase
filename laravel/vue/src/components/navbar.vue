<script setup>
  import { RouterLink, useRouter, useRoute } from 'vue-router';
  import { useStore } from 'vuex';
  import {computed, onMounted} from 'vue'
  import axios from 'axios'

  // access the store
  const store = useStore()
  const auth = computed(() => store.state.auth) // checks if the user is authenticated
  const admin = computed(() => store.state.admin) // checks if the user is an admin

  const apiUrl = import.meta.env.VITE_API_BASE_URL // declares the api url from the .env file
  const router = useRouter() // access the router
  const route = useRoute() // access the route
  // logs the user out
  async function logOut() {

    //crete the headers for the request
    try {
      await axios.post(apiUrl + '/api/logout', [], {headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Authorization': 'Bearer ' + localStorage.getItem('token'),
      }, withCredentials: true}) // makes the request to the api to remove the session cookie
    } catch (e) {
      console.log(e)
    }
    await store.dispatch('setAuthentication', false) // sets the authentication to false
    await store.dispatch('setadmin', false) // sets the admin to false
    await store.dispatch('setUserID', -1) // sets the user id to -1 ==> P.S i have no idea why it does this antons was wondering why now i know why this happens

    router.push("/") // redirects the user to the home page
  }

</script>

<template>
<nav class=" shadow-md border-neutral-500 border-b">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-3">
    <router-link to="/" class="flex items-center">
        <span id="logo" class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">\ CodeBranch \</span>
    </router-link>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto my-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 text-sm my-auto border rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0">
        <li v-if="!auth">
          <router-link active-class="active" :to="'/'" class=" cursor-pointer block py-2 pl-3 pr-4 rounded md:bg-transparent md:p-0 text-neutral-500">// Home</router-link>
        </li>
        <li v-if="auth">
          <router-link active-class="active" :to="'/'" class=" cursor-pointer block py-2 pl-3 pr-4 rounded md:bg-transparent md:p-0 text-neutral-500">// Search</router-link>
        </li>
        
        <li v-if="route.path != '/user/' + store.state.id + '/account' && auth">
          <router-link active-class="active" :to="'/user/' + store.state.id + '/code'" class="cursor-pointer block py-2 pl-3 pr-4 rounded md:bg-transparent md:p-0 text-neutral-500">// Manage</router-link>
        </li>
        <li v-if="route.path == '/user/' + store.state.id + '/account' && auth">
          <router-link active-class="active" :to="'/user/' + store.state.id + '/account'" class="cursor-pointer block py-2 pl-3 pr-4 rounded md:bg-transparent md:p-0 text-neutral-500">// Manage</router-link>
        </li>

        <li v-if="admin">
          <router-link active-class="active" :to="'/admin'" class="cursor-pointer block py-2 pl-3 pr-4 rounded md:bg-transparent md:p-0 text-neutral-500">// Admin</router-link>
        </li>
        <li>
          <router-link active-class="active" :to="'/about'" class="cursor-pointer block py-2 pl-3 pr-4 rounded md:bg-transparent md:p-0 text-neutral-500">// About</router-link>
        </li>
      </ul>
    </div>
    <button v-show="auth" @click="logOut()" type="button" class="text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 border dark:hover:bg-gray-800 focus:outline-none dark:focus:ring-blue-800">Sign Out</button>
    <button id="openLogin" v-show="!auth"  type="button" class="text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 border dark:hover:bg-gray-800">Sign In</button>
  </div>
</nav>
</template>