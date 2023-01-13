const nameLocalStorage = "STUDENT_TOKEN"
const state = {
    nameLocalStorage: nameLocalStorage,
    token: localStorage.getItem(nameLocalStorage) || null,
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
    },
  }

  const getters = {
    isAuthenticated (state) {
      return state.token != null
    },
  }
  
  export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
  }