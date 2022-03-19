import Vue from 'vue'
import App from './App.vue'
import router from './router'
import bootstrap from 'bootstrap'
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

Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
