import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store/index'
import CoreuiVue from '@coreui/vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.config.productionTip = false
Vue.use(CoreuiVue)
Vue.use(VueSweetalert2);
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
Vue.component('v-select', vSelect)

axios.defaults.baseURL = "http://127.0.0.1:8000/api";
// axios.defaults.baseURL = "http://api.akukonselor.com/api";

Vue.use(VueAxios, axios)

import { cilCog, cilTrash, cilGroup, cilArrowLeft, cilArrowRight, cilArrowTop, cilArrowBottom } from '@coreui/icons'

new Vue({
  router,
  store,
  icons: { cilCog, cilTrash, cilGroup, cilArrowLeft, cilArrowRight, cilArrowTop, cilArrowBottom },
  render: h => h(App)
}).$mount('#app')
