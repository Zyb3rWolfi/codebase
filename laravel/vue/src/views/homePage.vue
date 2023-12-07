<template>
    <Search v-if="store.state.auth" />
    <guestHome id="guestHome" v-else />

</template>

<script setup>
import { onBeforeMount, ref, onMounted } from 'vue'
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';
import Search from '../views/Search.vue'
import guestHome from '../components/guestHome.vue' 

// Instances of the router and store
const router = useRouter()
const store = useStore()


onMounted(() => {

})

</script>