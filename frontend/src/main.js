import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store/index'
import CoreuiVue from '@coreui/vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import './assets/scss/style.scss';
Vue.config.productionTip = false
Vue.use(CoreuiVue)
Vue.use(VueSweetalert2);
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
Vue.component('v-select', vSelect)

axios.defaults.baseURL = "http://127.0.0.1:8000/api/admin/";
// axios.defaults.baseURL = "http://api.akukonselor.com/api/admin/";

// const baseURL1 = "http://127.0.0.1:8000/api/admin/";
// const baseURL2 = "http://127.0.0.1:8000/api/teacher/";

// const baseURLAdmin = axios.create({
//   baseURL: baseURL1
// });

// export const baseURLTeacher = axios.create({
//   baseURL: baseURL2
// });

// axios.interceptors.response.use(undefined, function (error) {
axios.interceptors.response.use(function (response) {
  return response
}, function (error) {
  if (error) {
    const originalRequest = error.config;
    if (error.response.status === 401 && !originalRequest._retry) {

      originalRequest._retry = true;
      store.dispatch("auth/logout")
      return router.push({ name: "Login" })
    }
    return Promise.reject(error);
  }
})


Vue.use(VueAxios, axios)

import { cilX, cilPlus, cilCog, cilTrash, cilGroup, cilArrowLeft, cilArrowRight, cilArrowTop, cilArrowBottom, cilPencil, cilLockLocked, cilEnvelopeClosed, cilPrint } from '@coreui/icons'

new Vue({
  router,
  store,
  icons: { cilX, cilPlus, cilCog, cilTrash, cilGroup, cilArrowLeft, cilArrowRight, cilArrowTop, cilArrowBottom, cilPencil, cilLockLocked, cilEnvelopeClosed, cilPrint },
  render: h => h(App)
}).$mount('#app')
