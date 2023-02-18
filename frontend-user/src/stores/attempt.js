import { defineStore } from 'pinia'
import { useAuthStore } from './auth.js'
import axios from 'axios'
export const useAttemptStore = defineStore('attempt', {

    state: () => ({
        token: useAuthStore().token,
        url: import.meta.env.VITE_API_URL,
        angket_id: null,
        soal_id: null,
        jawaban: "",
    }),
    actions: {
        set_jawaban(value) {
            this.jawaban = value
        },
        set_init(angket_id, soal_id, jawaban) {
            this.angket_id = angket_id
            this.soal_id = soal_id
            this.jawaban = jawaban
        },
        async saveAnswer() {
            if (this.jawaban == '') {
                return
            }
            try {
                const { data } = await axios.post(`${this.url}/angket/${this.angket_id}/attempt/${this.soal_id}/answer`, {
                    jawaban: this.jawaban
                }, {
                    headers: {
                        Authorization: `Bearer ${this.token}`
                    }
                })
            } catch (e) {
                this.error = true
                if (e.name == "AxiosError") {
                    let { message } = e.response.data
                    this.message = message
                } else {
                    this.message = `Client side error! : ${e}`
                }
            }
        },
    },
})

