import { defineStore } from 'pinia'

export const useLayoutStore = defineStore('layout', {
  state: () => ({
    sidebar: false,
    navigation: false,
  }),
  getters: {
    all_expanded() {
      return this.sidebar && this.navigation
    },
  },
  actions: {
    set_sidebar(value) {
      this.sidebar = value
    },
    set_navigation(value) {
      this.navigation = value
    }
  },
})

