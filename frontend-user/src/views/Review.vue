<template>
    <div class="card" v-if="!loading">
        <div class="d-flex align-items-end row">
            <div class="col-sm-12">
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-lg-3" :class="{ 'layout_expanded': all_expanded }">
                                <div class="card p-0 shadow-none bg-transparent border border-secondary mb-3">
                                    <div class="card-body p-2 py-3">
                                        <h1 class="h6 mb-0">Butir <strong>{{ number }}</strong></h1>
                                        <small v-if="!answered">Belum diisi</small>
                                        <small v-else>Sudah diisi</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9" :class="{ 'layout_expanded': all_expanded }">
                                <div class="card shadow-none alert-info text-black border border-secondary mb-3">
                                    <div class="card-body py-2 pb-5">
                                        <p class="mb-3">{{ soal.soal }}</p>
                                        <div class="answer">
                                            <div class="py-1">
                                                <input :disabled="attempt_finished" :style="attempt_finished ? 'cursor: no-drop;' : ''" v-model="jawaban" type="radio" name="jawaban" value="1">
                                                <label for="answertrue" class="ms-1" @click="jawaban = 1">Ya</label>
                                            </div>
                                            <div class="py-1">
                                                <input :disabled="attempt_finished" :style="attempt_finished ? 'cursor: no-drop;' : ''" v-model="jawaban" type="radio" name="jawaban" value="0">
                                                <label for="answerfalse" class="ms-1" @click="jawaban = 0">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-lg-6" :class="{ 'layout_expanded_for_button': all_expanded }">
                                <button v-if="btnprev" type="button" name="prev" class="btn btn-secondary"
                                    @click="submit(btnprev.previous_number)">{{
                                        btnprev.text
                                    }}</button>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end"
                                :class="{ 'layout_expanded_for_button': all_expanded }" v-if="btnnext">
                                <button type="button" class="btn btn-primary" @click="submit(btnnext.next_number)">{{
                                    btnnext.text
                                }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
import { mapState, mapActions } from 'pinia'
import { useLayoutStore } from '@/stores/layout'
export default {
    name: "AttemptAngketReview",
    props: {
        id: String,
        token: String,
    },
    computed: {
        ...mapState(useLayoutStore, ['all_expanded']),
        attempt_finished() {
            if (this.attempt != null && this.attempt.state == 'onprogress') {
                return false
            }
            return true
        }
    },
    data() {
        return {
            error: false,
            message: "",
            url: import.meta.env.VITE_API_URL,
            loading: false,
            attempt: null,
            number: 1,
            soal: {
                id: null,
                soal: ''
            },
            answered: false,
            jawaban: '',
            btnnext: null,
            btnprev: null
        }
    },
    async created() {
        this.$watch(
            () => this.$route.query,
            () => {
                this.getData()
            },
            { immediate: true }
        )
        await this.statusAttempt()
    },
    methods: {
        async statusAttempt() {
            try {
                const { data } = await axios.get(`${this.url}/angket/${this.id}/status`, {
                    headers: {
                        Authorization: `Bearer ${this.token}`
                    }
                })
                this.attempt = data.data
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
        async getData() {
            try {
                this.loading = true
                let page = this.$route.query.page
                const { data } = await axios.get(`${this.url}/angket/${this.id}/attempt?page=${page ? page : 0}`, {
                    headers: {
                        Authorization: `Bearer ${this.token}`
                    }
                })
                this.number = data.data.meta.number
                this.soal.id = data.data.soal.id
                this.soal.soal = data.data.soal.soal
                if (data.data.jawaban != null) {
                    this.jawaban = data.data.jawaban.jawaban
                    this.answered = true
                }
                if (data.data.meta.previous_number) {
                    this.btnprev = {
                        previous_number: data.data.meta.previous_number,
                        text: 'Halaman sebelumnya'
                    }
                }
                this.btnnext = {}
                this.btnnext.next_number = data.data.meta.next_number
                if (data.data.meta.next_number) {
                    this.btnnext.text = "Halaman selanjutnya"
                } else {
                    this.btnnext.text = "Kembali kehalaman angket"
                }
                this.loading = false
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
        async submit(number) {
            this.move(number)
        },
        move(number) {
            let id = this.$route.query.id ? this.$route.query.id : 0
            if (number) {
                this.$router.push({ name: 'AttemptReview', query: { id: id, page: number - 1 } })
            } else {
                this.$router.push({ name: 'Angket', query: { id: id } })
            }
        }
    }
}
</script>
<style scoped>
@media (max-width: 1200px) {
    .layout_expanded {
        width: 100%;
    }
}

@media (max-width: 1200px) {
    .layout_expanded {
        width: 100%;
    }
}
</style>