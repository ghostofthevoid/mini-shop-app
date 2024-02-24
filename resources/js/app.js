import {createApp} from 'vue'
import App from './App.vue'
import router from './router/index.js'
import './bootstrap';
import axios from "axios";
import { autoAnimatePlugin } from '@formkit/auto-animate/vue'
import store from './store/index.js';

const app = createApp(App)

app.use(router)
app.use(store)
app.use(autoAnimatePlugin)
app.config.globalProperties.axios = axios
app.mount('#app')
