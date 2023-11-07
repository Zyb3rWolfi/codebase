import { createRouter, createWebHistory } from "vue-router";
import Login from "../views/Login.vue";
import Regi from "../views/SignUp.vue";
import User from "../views/User.vue";
import code from "../components/Code.vue";
import account from "../components/account.vue";
import homePage from "../views/homePage.vue";
import about from "../views/about.vue";
import store from "../store/index.ts";

const routes = [
    {
        path: '/',
        name: "home",
        component: homePage,
    },
    {
        path: '/login',
        name: "login",
        component: Login,
        
    },
    {
        path: '/register',
        name: "register",
        component: Regi,
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
        path: '/about',
        name: 'about',
        component: about,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from) => {
    const auth = store.state.auth;
    console.log(auth);
    if (
      // make sure the user is authenticated
      !auth &&
      // ❗️ Avoid an infinite redirect
      to.name !== 'login'
    ) {
      // redirect the user to the login page
      return { name: 'login' }
    }
  })


export default router