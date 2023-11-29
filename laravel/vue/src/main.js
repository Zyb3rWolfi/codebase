import { createApp } from 'vue'
import './css/style.css'
import router from '../src/router/index.js'
import App from './App.vue'
import 'highlight.js/styles/stackoverflow-light.css'
import 'highlight.js/lib/common';
import hljsVuePlugin from "@highlightjs/vue-plugin";
import VueCookies from 'vue-cookies';
import store from './store'
import { createAuth0 } from '@auth0/auth0-vue'



createApp(App)
    .use(hljsVuePlugin)
    .use(router)
    .use(VueCookies)
    .use(store)
    .use(createAuth0({
        domain: "dev-thj0fjfpq2dexdh4.us.auth0.com",
        clientId: "NyaN0PhsyNL644A4eJOFHlNTnXTFGkuW",
        onRedirectCallback: appState => {
            router.push(
                appState && appState.targetUrl
                ? appState.targetUrl
                : window.location.pathname
            );
        }
    }))
    .mount('#app')
    

