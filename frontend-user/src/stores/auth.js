const nameLocalStorage = "STUDENT_TOKEN"
import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    nameLocalStorage: nameLocalStorage,
    token: localStorage.getItem(nameLocalStorage) || null,
  }),
  getters: {
    isAuthenticated() {
      return this.token != null
    },
  },
  actions: {
    authenticated(token) {
      localStorage.setItem(nameLocalStorage, token)
      this.token = token
    },
    logout() {
      localStorage.removeItem(nameLocalStorage)
      this.token = null
    }
  },
})
