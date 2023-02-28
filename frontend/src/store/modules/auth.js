const nameLocalStorage = "ADMIN_PAGE_TOKEN"
const state = {
    nameLocalStorage: nameLocalStorage,
    token: localStorage.getItem(nameLocalStorage) || null,
    as: null,
  }
  
  const mutations = {
    setToken (state, token) {
        state.token = token
    },
    setAs (state, as) {
        state.as = as
    },
  }

  const actions = {
    authenticated ({ commit }, user) {
      commit('setToken', user.token)
      commit('setAs', user.as)
    },
    logout({ commit }) {
      window.localStorage.removeItem(nameLocalStorage)
      commit('setToken', null)
      commit('setAs', null)
    },
    logedAs ({ commit }, as){
      commit('setAs', as)
    }
  }

  const getters = {
    isAuthenticated (state) {
      return state.token != null
    },
    isAdmin (state) {
      return state.as == 'admin'
    },
    isSekolah (state) {
      return state.as == 'schools'
    },
    isGuru (state) {
      return state.as == 'teachers'
    },
  }
  
  export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
  }