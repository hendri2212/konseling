import { defineStore } from 'pinia'
import { useAuthStore } from './auth.js'
import axios from 'axios'
export const useAttemptStore = defineStore('attempt', {

    state: () => ({
        token: useAuthStore().token,
        survey_items: [],
        survey_id: null,
        survey_item_id: null,
        answer: "",
    }),
    actions: {
        setSurveyId(survey_id) {
            this.survey_id = survey_id
        },
        async getSurveyItems() {
            const { data } = await axios.get(`surveys/${this.survey_id}/attempt/lists`, {
                headers: {
                    Authorization: `Bearer ${this.token}`
                }
            })
            this.survey_items = data.data
        },
        setSurveyItemId_Answer(survey_item_id, answer) {
            this.survey_item_id = survey_item_id
            this.answer = answer
        },
        async saveAnswer() {
            if (this.answer == "") {
                return
            }
            await axios.post(`surveys/${this.survey_id}/attempt/${this.survey_item_id}/answer`, { answer: this.answer }, {
                headers: {
                    Authorization: `Bearer ${this.token}`
                }
            }).then(() => {
                let survey_item_index = this.survey_items.findIndex(survey_item => {
                    return survey_item.id == this.survey_item_id
                })
                
                if (survey_item_index < 0) {
                    return
                }

                this.survey_items[survey_item_index].answered = true
            })
        },
    },
})

