import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
import auth from './modules/auth'
import soal from './modules/soal'

export default new Vuex.Store({
  modules: {
    auth,
    soal,
  },
})