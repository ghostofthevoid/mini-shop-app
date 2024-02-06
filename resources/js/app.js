import {createApp} from 'vue'
import App from './App.vue'
import router from './router/index.js'
import './bootstrap';
import axios from "axios";
import { autoAnimatePlugin } from '@formkit/auto-animate/vue'

const app = createApp(App)

app.use(router)
app.use(autoAnimatePlugin)
app.config.globalProperties.axios = axios
app.mount('#app')
