<template>

<div class="text-sm font-medium text-center text-gray-500 border-gray-200 dark:text-gray-400 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px">
        <li class="mr-2" @click="codeButton()">
            <a href="#" class="border-blue-500 inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 active" aria-current="page">Code Blocks</a>
        </li>
        <li class="mr-2" @click="accountButton()">
            <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Account</a>
        </li>

    </ul>
</div>

</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';
import { computed } from 'vue';
const store = useStore()

const router = useRouter()

function accountButton() {
    router.push("/user/" + store.state.id + "/account")
}

function codeButton() {
    router.push("/user/" + store.state.id + "/code")
}

function goBack() {
    router.push("/")
}

</script>
