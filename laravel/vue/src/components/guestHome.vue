<template>

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
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router';
import { initFlowbite, Modal } from 'flowbite'
import { useStore } from 'vuex';

const router = useRouter()
const store = useStore()

function signIn() {
    router.push("/login")
}

function signUp() {
    router.push("/register")
}

onMounted(() => {
    initFlowbite()

    const $signUpButon = document.getElementById('openSignUp')
    const $loginButton = document.getElementById('openLoginModal')
    const $signInButton = document.getElementById('openLogin')
    const $target = document.getElementById('loginRegisterModal')
    const $submitButton = document.getElementById('submitButton')
    const $submitButtonRegister = document.getElementById('submitButtonRegister')

    
    const options = {

        closable: true,
    };

    if($target){
        const modal = new Modal($target, options)

        $signUpButon.addEventListener('click', () => toggleSignUpModal(2,modal))
        $loginButton.addEventListener('click', () => toggleSignUpModal(1, modal))
        $signInButton.addEventListener('click', () => toggleSignUpModal(1, modal))
        $submitButton.addEventListener('click', () => modal.hide())
        $submitButtonRegister.addEventListener('click', () => modal.hide())
    }


})
async function toggleSignUpModal(state, modal){
    await store.dispatch('setSignupModalState', state)
    modal.toggle()
}
</script>