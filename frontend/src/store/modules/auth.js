const state = {
    token: localStorage.getItem("SCHOOL_TOKEN") || null,
  }
  
  const mutations = {
    authenticated (state, { token }) {
        state.token = token
    }
  }
  
  export default {
    namespaced: true,
    state,
    mutations,
  }