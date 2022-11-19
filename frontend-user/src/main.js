import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store/index'
import bootstrap from 'bootstrap'
import axios from 'axios'
import VueAxios from 'vue-axios'
// import 'bootstrap/dist/css/bootstrap.min.css'
import '@/assets/custom.scss'

// collapse
// var collapseElementList = [].slice.call(document.querySelectorAll('.collapse'))
// collapseElementList.map(function (collapseEl) {
//   return new bootstrap.Collapse(collapseEl)
// })

// offcanvas
var offcanvasElementList = [].slice.call(document.querySelectorAll('.offcanvas'))
offcanvasElementList.map(function (offcanvasEl) {
  return new bootstrap.Offcanvas(offcanvasEl)
})
// axios.defaults.baseURL = "http://127.0.0.1:8000/api";
axios.defaults.baseURL = "http://api.akukonselor.com/api";
Vue.use(VueAxios, axios)
Vue.config.productionTip = false
new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
