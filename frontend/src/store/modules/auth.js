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
    logedAs ({ commit }, as){
      commit('setAs', as)
    }
  }

  const getters = {
    isAuthenticated (state) {
      return state.token != null
    },
    isSekolah (state) {
      return state.as == 'sekolah'
    },
    isGuru (state) {
      return state.as == 'guru'
    },
  }
  
  export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
  }