<template>
    <footer class="rounded-lg shadow mx-auto absolute mt-72 w-full m-10" style="background-color: #23272f;">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">CodeBranch</a>. All Rights Reserved.
        </span>
        <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
            <li>
                <router-link to="/about" href="#" class="mr-4 hover:underline md:mr-6 ">About</router-link>
            </li>
            <li>
                <router-link to="/privacy" href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</router-link>
            </li>
        </ul>
        </div>
    </footer>

</template>

<script setup>

</script>

<style scoped>

</style>