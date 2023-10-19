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
import axios from 'axios';
import store from './store'
import { install as VueMonacoEditorPlugin } from '@guolao/vue-monaco-editor'


createApp(App)
    .use(hljsVuePlugin)
    .use(router)
    .use(VueCookies)
    .use(store)
    .use(VueMonacoEditorPlugin, {
        paths: {
          // The recommended CDN config
          vs: 'https://cdn.jsdelivr.net/npm/monaco-editor@0.38.0/min/vs'
        },
      })
    .mount('#app')
    

