<script setup>
import axios from 'axios';
import NavBar from './components/navbar.vue';
import footerComp from './components/footer.vue';
import { onMounted } from 'vue';
import { useStore } from 'vuex';
const store = useStore();

onMounted(async ()=> {
  try {
      const headers = {
          Accept: 'application/json',
          'content-type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'}
          const response = await axios.get('http://127.0.0.1:8000/api/user', {headers: headers, withCredentials: true})
          console.log(response.data)
          await store.dispatch('setAuthentication', true)
          await store.dispatch('setUserID', response.data["id"])
          console.log(store.state.id)


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


</template>

<style scoped>
</style>
