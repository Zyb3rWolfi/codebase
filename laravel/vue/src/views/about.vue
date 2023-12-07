
<template>
    <div class="mx-auto lg:grid-cols-3 sm:grid-cols-1 md-grid-cols-2 grid container mt-20 justify-items-center">
        <div class="col-start-2">
            <div class="row">
                <h2 id="title" class="text-5xl">What is Code<br>Branch?</h2>
            </div>

        </div>
        <div class="col-start-2">
            <div class="row mt-10 text-center">
                <hr class="h-px my-2 bg-gray-200 border-2 mb-10 mx-auto dark:bg-gray-700 w-90">
                <p>Imagine a world where finding that one perfect piece of code doesn't involve a wild goose chase through your files. That's what CodeBranch brings to the table – a cozy space where you can stash your code snippets in neat little blocks. Your coding closet just got a whole lot tidier!</p>
                <p class="mt-5">But here's the kicker: searching for your gems is a breeze. No more digging through folders like you're on an archeological expedition. Just type in a keyword, hit search, and voila – your snippet is right there, ready to shine.</p>
            </div>
        </div>
        <div class=" col-start-2">
            <div class=" row mt-10 text-center">
                <h2 id="title" class=" text-2xl">Developers</h2>
                <p class=" mt-5">Creator - Antons Cereskevics</p>
                <p class="">Developer - Zakk Amers-Delp</p>
            </div>
        </div>
    </div>
    <loginRegister />
</template>
<script setup>
    import {  onMounted, computed } from 'vue'
    import { Modal } from 'flowbite'
    import { useStore } from 'vuex';
    import loginRegister from "../views/loginRegisterView.vue"
    import '../css/guestStyle.css'

    const store = useStore()
    const auth = computed(() => store.state.auth)

    onMounted(() => {

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