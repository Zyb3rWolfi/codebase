<template>

<div class="text-sm font-medium text-center text-gray-500 border-gray-200 dark:text-gray-400 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px">
        <router-link active-class="manageActive" :to="'/user/' + store.state.id + '/code'"  class="mr-2">
            <a href="#" class=" text-white border-blue-500 inline-block p-4 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Code Blocks</a>
        </router-link>
        <router-link active-class="manageActive" :to="'/user/' + store.state.id + '/account'" class="mr-2">
            <a href="#" class="text-white inline-block p-4 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Account</a>
        </router-link>
        

    </ul>
</div>

</template>

<script setup>
import { ref, setBlockTracking } from 'vue'
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';
import { computed } from 'vue';
const store = useStore()
const router = useRouter()
var selected = ref("code")

function accountButton() {
    router.push("/user/" + store.state.id + "/account")
    this.selected = "account"
}

function codeButton() {
    router.push("/user/" + store.state.id + "/code")
    this.selected = "code"
}

function goBack() {
    router.push("/")
}

</script>
