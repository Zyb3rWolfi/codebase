<template id="guestHome">
    <div id="stars"></div>
    <div id="stars2"></div>
    <div id="stars3"></div>
    <div class=" grid lg:grid-cols-3 grid-rows-3 mt-40 sm:grid-cols-1 md:grid-cols-3 justify-items-center mx-auto">
        <div class="col-start-2 text-center">
            <h1 id="title" class=" text-4xl row-start-1">A Safe Place For Your Code</h1>
            <h2 id="sub" class="row-start-2 mt-5">Save it, Copy it</h2>
            
            <div class="mt-10">
                <button id="openSignUp" type="button" class="mr-10 text-black bg-neutral-200 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 border dark:hover:bg-gray-400">Sign Up</button>
                <button id="openLoginModal" type="button" class="text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 border dark:hover:bg-gray-800">Sign In</button>
            </div>

        </div>   
    </div>
    <loginRegister />
</template>

<script setup>
import {  onMounted,  computed } from 'vue'
import { initFlowbite, Modal } from 'flowbite'
import { useStore } from 'vuex';
import loginRegister from "../views/loginRegisterView.vue"
import '../css/guestStyle.css'

const store = useStore()
const auth = computed(() => store.state.auth)

onMounted(() => {
    initFlowbite()

    document.documentElement.style.overflow = 'hidden';

    const $signUpButon = document.getElementById('openSignUp')
    const $loginButton = document.getElementById('openLoginModal')
    const $signInButton = document.getElementById('openLogin')
    const $target = document.getElementById('loginRegisterModal')
    const $submitButton = document.getElementById('submitButton')
    const $submitButtonRegister = document.getElementById('submitButtonRegister')
    const $close = document.getElementById('closeButton')
    const $closeregister = document.getElementById('closeButtonRegister')


    
    const options = {
        closable: true,
        backdropClasses: '',
    };
    const instanceOptions = {
        id: 'modalEl',
        override: true
        };

    if($target){

        const modal = new Modal($target, options, instanceOptions)

        $signUpButon.addEventListener('click', () => toggleSignUpModal(2,modal))
        $loginButton.addEventListener('click', () => toggleSignUpModal(1, modal))
        $signInButton.addEventListener('click', () => toggleSignUpModal(1, modal))
        $submitButtonRegister.addEventListener('click', () => closeModal(modal))
        $closeregister.addEventListener('click', () => modal.hide())
        $submitButton.addEventListener('click', () => closeModal(modal))
        $close.addEventListener('click', () => modal.hide())
    }

})

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
</script>