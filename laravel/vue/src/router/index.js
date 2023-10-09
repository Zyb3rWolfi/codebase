import { createRouter, createWebHistory } from "vue-router";
import Search from "../views/Search.vue";
import Login from "../views/Login.vue";

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
    },
    {
        path: '/login',
        name: "login",
        component: Login,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;