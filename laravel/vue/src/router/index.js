import { createRouter, createWebHistory } from "vue-router";
import Search from "../views/Search.vue";

const routes = [
    {
        path: '/search',
        name: "search",
        component: Search,
    },
    {
        path: '/',
        name: "search",
        component: Search,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;