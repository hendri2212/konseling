import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store/index'
import axios from 'axios'
import VueAxios from 'vue-axios'
import "@/assets/scss/core.scss";
import '@/assets/scss/theme-default.scss'

import "@/assets/js/config.js";
import "@/assets/js/helpers.js";
import "@/assets/js/libs/jquery/jquery.js";
import "@/assets/js/libs/popper/popper.js";
import "@/assets/js/bootstrap.js";
import "@/assets/js/libs/perfect-scrollbar/perfect-scrollbar.js";
import "@/assets/js/menu.js";
import "@/assets/js/libs/apex-charts/apexcharts.js";
import "@/assets/js/main.js";
import "@/assets/js/dashboards-analytics.js";


axios.defaults.baseURL = "http://127.0.0.1:8000/api";
// axios.defaults.baseURL = "http://api.akukonselor.com/api";
Vue.use(VueAxios, axios)
Vue.config.productionTip = false
new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
