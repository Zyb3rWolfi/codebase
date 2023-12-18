import { createApp } from 'vue'
import './css/style.css'
import router from '../src/router/index.js'
import App from './App.vue'
import 'highlight.js/styles/stackoverflow-light.css'
import 'highlight.js/lib/common';
import hljsVuePlugin from "@highlightjs/vue-plugin";
import VueCookies from 'vue-cookies';
import store from './store'



createApp(App)
    .use(hljsVuePlugin)
    .use(router)
    .use(VueCookies)
    .use(store)
    .mount('#app')
    

