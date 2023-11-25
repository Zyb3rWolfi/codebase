<template>

    <div v-if="toasts.length" class="z-40">
        <toast v-for="toast in toasts" :toast="toast">
        </toast>
    </div>

</template>

<script>
import { useStore } from 'vuex';
import toast from '../components/toast.vue';
export default {
    name: 'Toasts',
    components: {
        toast
    },
    setup() {
        const store = useStore();
        return { store }
    },
    computed: {
        toasts() {
            return this.store.state.toasts;
        }
    },
}
</script>