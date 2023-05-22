<template>
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-12">
                <div class="card-body" v-if="attempt != ''">
                    <div v-if="!attempt">
                        <button @click="startattempt" class="btn btn-primary mb-3 px-5">
                            Isi angket
                            <!-- {{ 'ISI ANGKET' 'Lanjutkan pengisian angket yang terakhir' }} -->
                        </button>
                        <p class="m-0">Diizinkan mengisi angket</p>
                    </div>
                    <div v-else>
                        <div class="card mb-5">
                            <h5 class="card-header">Ringkasan pengisian angket sebelumnya</h5>
                            <div class="table-responsive text-nowrap ">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Keadaan</th>
                                            <th>Ulasan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <tr v-if="attempt.state == 'inprogress'">
                                            <td>Sedang diisi</td>
                                            <td></td>
                                        </tr>
                                        <tr v-else>
                                            <td>
                                                Selesai mengerjakan <br>
                                                <small class="d-blok">Diserahkan pada {{ v_moment(attempt.timefinish) }}</small>
                                            </td>
                                            <td>
                                                <router-link :to="{ name: 'AttemptReview', query: { id: id } }">Ulasan</router-link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-center" v-if="attempt.state == 'inprogress'">
                            <button @click="startattempt" class="btn btn-primary mb-3 px-5">
                                LANJUTKAN PENGISIAN ANGKET
                            </button>
                            <p class="m-0">Diizinkan mengisi angket</p>
                        </div>
                        <div class="text-center" v-else>
                            <router-link :to="{ name: 'Dashboard' }" class="btn btn-primary mb-3">
                                KEMBALI KE DASHBOARD
                            </router-link>
                            <p class="m-0">Tidak ada lagi percobaan yang diperbolehkan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment'
export default {
    name: "Angket",
    props: {
        id: String,
        token: String,
    },
    data() {
        return {
            error: false,
            message: "",
            attempt: '',
        }
    },
    async created() {
        try {
            const { data } = await this.axios.get(`surveys/${this.id}/status`, {
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
    methods: {
        v_moment(time) {
            return moment(time).locale('id').format('LLLL')
        },
        async startattempt() {
            try {
                const { data } = await this.axios.post(`surveys/${this.id}/start-attempt`, {}, {
                    headers: {
                        Authorization: `Bearer ${this.token}`
                    }
                })
                this.attempt = data.data
                this.$router.push({ name: 'Attempt', query: { id: this.id } })
            } catch (e) {
                this.error = true
                if (e.name == "AxiosError") {
                    let { message } = e.response.data
                    this.message = message
                } else {
                    this.message = `Client side error! : ${e}`
                }
            }
        }
    }
}
</script>