import Vue from 'vue'
import App from './App.vue'
import router from './router'
import CoreuiVue from '@coreui/vue'
import { iconsSet as icons } from './assets/icons/icons.js'

Vue.config.productionTip = false
Vue.use(CoreuiVue)

new Vue({
  router,
  icons,
  render: h => h(App)
}).$mount('#app')
