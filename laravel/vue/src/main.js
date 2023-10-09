import { createApp } from 'vue'
import './style.css'
import './index.css'
import router from '../src/router/index.js'
import App from './App.vue'

createApp(App)
    .use(router)
    .mount('#app')
