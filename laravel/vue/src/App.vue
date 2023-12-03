<script setup>
import axios from 'axios';
import NavBar from './components/navbar.vue';
import { onMounted } from 'vue';
import { useStore } from 'vuex';
import Toasts from './components/Toasts.vue';
import fter from './components/footer.vue';
const store = useStore();
const apiUrl = import.meta.env.VITE_API_BASE_URL
onMounted(async ()=> {
  try {
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('token');

    const errorParams = new URLSearchParams(window.location.search);
    const errorParam = errorParams.get('error');

    if (errorParam) {
      var url = new URL(window.location.href);
      url.searchParams.delete('error');
      window.history.replaceState({}, '', url);

      store.commit('ADD_TOAST', {
          title: 'Sorry, that email is already in use.',
          type: 'error',
          id: Math.floor(Math.random() * 50),
          duration: 5000
      })
    }

    if (myParam) {
      localStorage.setItem('token', myParam)
      const url = new URL(window.location.href);
      url.searchParams.delete('token');
      window.history.replaceState({}, '', url);

      store.commit('ADD_TOAST', {
          title: 'Logged in successfully.',
          type: 'success',
          id: Math.floor(Math.random() * 50),
          duration: 5000
      })
    }

      const headers = {
          Accept: 'application/json',
          'content-type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'Authorization': 'Bearer ' + localStorage.getItem('token')}
          const response = await axios.get(apiUrl + '/api/user', {headers: headers, withCredentials: true}).then(function(response) {
          
            store.dispatch('setAuthentication', true)
            store.dispatch('setUserID', response.data["id"])
          
          })

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
  <Toasts class=" fixed right-2 bottom-2"></Toasts>
</template>
<style scoped>
</style>
