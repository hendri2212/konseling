import { defineStore } from 'pinia'

export const useSoalStore = defineStore('soal', {
  state: () => ({
    numbers: []
  }),
  actions: {
    setNumbers(numbers) {
      this.numbers = numbers
    },
    setAnswered(index) {
      this.numbers[index].isAnswered = true
    }
  },
})
