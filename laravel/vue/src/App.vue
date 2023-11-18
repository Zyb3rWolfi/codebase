<script setup>
import axios from 'axios';
import NavBar from './components/navbar.vue';
import { onMounted } from 'vue';
import { useStore } from 'vuex';
import Toasts from './components/Toasts.vue';
const store = useStore();

onMounted(async ()=> {
  try {
      const headers = {
          Accept: 'application/json',
          'content-type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'}
          const response = await axios.get('http://codebranch.me/api/user', {headers: headers, withCredentials: true}).then
          await store.dispatch('setAuthentication', true)
          await store.dispatch('setUserID', response.data["id"])

      } catch(e) {
      await store.dispatch('setAuthentication', false) 
      }
})
</script>


<template>
  <header>
    <NavBar></NavBar>
  </header>
  <router-view></router-view>
  <Toasts class=" absolute right-2 bottom-2"></Toasts>
</template>

<style scoped>
</style>
