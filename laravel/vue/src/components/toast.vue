<template>

    <div @transitionend="removeFromDom" v-if="this.remove == false" v-bind:class="{hide : !show, unhide : show}" :id="'f' + toast.id" class="mb-3 flex items-center w-full max-w-xs p-4  rounded-lg shadow text-gray-400 bg-gray-800" role="alert">
        
        <div v-if="this.toast.type == 'warning'" class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8  rounded-lg bg-orange-700 text-orange-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
        </svg>
        <span class="sr-only">Warning icon</span>
        </div>

        <div v-if="this.toast.type == 'error'" class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8  rounded-lg bg-red-800 text-red-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
        </svg>
        <span class="sr-only">Error icon</span>
        </div>

        <div v-if="this.toast.type == 'success'" class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8  rounded-lg bg-green-800 text-green-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
        </svg>
        <span class="sr-only">Check icon</span>
        </div>

        <div class="ml-3 text-sm font-normal">{{ toast.title }}</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5  rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex items-center justify-center h-8 w-8 text-gray-500 hover:text-white bg-gray-800 hover:bg-gray-700" :data-dismiss-target="'#f' + toast.id" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>

</template>

<script>
import { initFlowbite } from 'flowbite';

export default {
    name: 'toast',
    props: {
        toast: {
            required: true,
            type: Object,
        }
    },
    data() {
        return {
            show: true,
            remove: false,
        }
    },
    mounted() {
        initFlowbite()
        this.dismiss()
    },

    methods: {
        dismiss() {
            setTimeout(() => {

                this.show = false
            }, 5000)
        },

        removeFromDom() {
            if (this.show == false) {
                this.remove = true
            }
        }
    }
}
</script>

<style scoped>

div.unhide {
    opacity: 1;
    transition: opacity 0.5s ease-out;

}
div.hide {
    opacity: 0;
    transition: opacity 0.5s ease-in;
}

</style>