<template>
    <div id="sharedBlock" class="my-16">
        <div class=" flex flex-wrap justify-center">
            <div v-if="loading" role="status" class=" mt-20">
                <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
            <div v-if="!loading" class=" w-1/2">
                <div class=" mb-5">
                    <h1 id="title" class="text-3xl font-bold">{{props.title}}</h1>
                    <h2 class=" mt-2">{{ props.description }}</h2>
                </div>
                <CodeEditor :line-nums="true" font-size="15px" :value="props.code" width="100%" min-height="500px" height="100%" :read-only="true" :languages="[[props.language]]" />

            </div>
        </div>
    </div> 
    <loginRegister />   
</template>
<script setup>
import { onBeforeMount, onMounted, ref, computed } from 'vue';
import {useRoute } from 'vue-router';
import axios from 'axios';
import CodeEditor from "simple-code-editor";
import { Modal } from 'flowbite'
import loginRegister from "../views/loginRegisterView.vue"
import { useStore } from 'vuex';

const apiUrl = import.meta.env.VITE_API_BASE_URL
var props = ref([])
const route = useRoute() // access the router
var loading = ref(false)
const store = useStore()
const auth = computed(() => store.state.auth)
async function getResponse(token, header) {

    loading.value = true
    // If the search is empty we will empty the answer array and return
    if (token === '') {
        answer = [];
        return;
    }
        // Otherwise we will make a request to the api and set the answer array to the response
        const response = await axios.get(apiUrl + '/api/getSharedBlock/' + token, {headers: header, withCredentials: true});
        var answer = response.data["strings"];
        props.value = answer[0]
        loading.value = false
    } 

onMounted(() => {
    

        const $signInButton = document.getElementById('openLogin')
        const $target = document.getElementById('loginRegisterModal')
        const $submitButton = document.getElementById('submitButton')
        const $submitButtonRegister = document.getElementById('submitButtonRegister')
        const $close = document.getElementById('closeButton')
        const $closeregister = document.getElementById('closeButtonRegister')

        const options = {
            closable: true,
            backdrop: 'dyanmic',
            backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
        };

        const instanceOptions = {
            id: 'modalEl',
            override: true
            };

            if($target){
                const modal = new Modal($target, options, instanceOptions)

                $signInButton.addEventListener('click', () => toggleSignUpModal(1, modal))
                $submitButtonRegister.addEventListener('click', () => closeModal(modal))
                $closeregister.addEventListener('click', () => modal.hide())
                $submitButton.addEventListener('click', () => closeModal(modal))
                $close.addEventListener('click', () => modal.hide())

        }
    });
    
    function closeModal(modal) {
        setTimeout(() => {
            if (auth.value){
                modal.hide()
            }
        }, 2000);
    }
    
    async function toggleSignUpModal(state, modal){
        await store.dispatch('setSignupModalState', state)
        modal.toggle()
    }


onBeforeMount(() => {
    var $token = route.params.token // access the token parameter from the url

    var header = {
        Accept: 'application/json',
        'content-type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }
    getResponse($token, header)
    
});

</script>