const state = {
    numbers:[]
  }
  
  const mutations = {
    setNumbers (state, numbers) {
        state.numbers = numbers
    },
    setAnswered (state, index){
      state.numbers[index].isAnswered = true
    }
  }
  
  export default {
    namespaced: true,
    state,
    mutations,
  }