import { createRouter, createWebHistory } from "vue-router";
import User from "../views/User.vue";
import code from "../components/code.vue";
import account from "../components/account.vue";
import homePage from "../views/homePage.vue";
import about from "../views/about.vue";
import privacy from "../views/privacyNotice.vue";
import share from "../views/share.vue";

const routes = [
    {
        path: '/',
        name: "home",
        component: homePage,
    },
    {
        path: '/user/:id',
        name: "user",
        component: User,
        children: [
            {
                path: 'code',
                component: code,
            },
            {
                path: 'account',
                component: account,
            }
        ]
    },
    {
        path: '/privacy',
        name: 'privacy',
        component: privacy,
    },
    {
        path: '/about',
        name: 'about',
        component: about,
    },
    {
        path: '/share/:token',
        name: 'share',
        component: share,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});


export default router