import { createApp } from 'vue'
import { createPinia } from 'pinia'
import axios from 'axios'
import VueAxios from 'vue-axios'

import App from './App.vue'
import router from './router'

import '@/assets/libs/jquery/jquery.js'
import '@/assets/libs/popper/popper.js'
import '@/assets/js/bootstrap.js'
import '@/assets/libs/perfect-scrollbar/perfect-scrollbar.js'
import 'moment/locale/id.js';

const app = createApp(App)

axios.defaults.baseURL = import.meta.env.VITE_API_URL

app.use(VueAxios, axios)
app.use(createPinia())
app.use(router)

app.mount('#app')

