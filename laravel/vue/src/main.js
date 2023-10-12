import { createApp } from 'vue'
import './style.css'
import './atom-one-dark.css'
import './index.css'
import router from '../src/router/index.js'
import App from './App.vue'
import 'highlight.js/styles/stackoverflow-light.css'
import 'highlight.js/lib/common';
import hljsVuePlugin from "@highlightjs/vue-plugin";
import VueCookies from 'vue-cookies';

createApp(App)
    .use(hljsVuePlugin)
    .use(router)
    .use(VueCookies)
    .mount('#app')
