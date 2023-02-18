<template>
    <div class="card" v-if="!loading">
        <div class="d-flex align-items-end row">
            <div class="col-sm-12">
                <div class="card-body">
                    <div>
                        <div class="card mb-5">
                            <h5 class="card-header">Rangkuman hasil pengerjaan angket</h5>
                            <div class="table-responsive text-nowrap ">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Soal</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <tr v-for="soal in lists">
                                            <td>{{ soal.order }}</td>
                                            <td>
                                                <template v-if="soal.answered">Jawaban tersimpan</template>
                                                <template v-else>Belum dijawab</template>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-center">
                            <router-link :to="{ name: 'Attempt', query: { id: $route.query.id } }"
                                class="btn btn-secondary mb-3">
                                Mengerjakan kembali
                            </router-link>
                        </div>
                        <div class="text-center">
                            <button @click="finishattempt()" class="btn btn-primary mb-3">
                                Kirim semua dan selesai
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
import { mapState } from 'pinia'
import { useLayoutStore } from '@/stores/layout'
import Swal from 'sweetalert2'
export default {
    name: "AttemptAngketSummary",
    props: {
        id: String,
        token: String,
    },
    computed: {
        ...mapState(useLayoutStore, ['all_expanded'])
    },
    data() {
        return {
            error: false,
            message: "",
            url: import.meta.env.VITE_API_URL,
            loading: false,
            lists: []
        }
    },
    async created() {
        await this.getData()
    },
    methods: {
        async getData() {
            try {
                this.loading = true
                const { data } = await axios.get(`${this.url}/angket/${this.id}/attempt/lists`, {
                    headers: {
                        Authorization: `Bearer ${this.token}`
                    }
                })
                this.lists = data.data
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
        finishattempt() {
            let not_answered = this.lists.filter((p) => {
                return !p.answered
            }).length
            let alert_not_answered = ""
            if (not_answered > 0) {
                alert_not_answered = `<div class='alert alert-warning text-start fs-6' role='alert'>Butir pertanyaan tidak dijawab : ${not_answered} </div>`
            }
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary mx-2',
                    cancelButton: 'btn btn-secondary mx-2 margin-if-small'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                icon: 'info',
                html: `
                    <p class="mb-2 text-start fs-6">
                        Apakah anda yakin akan menyelesaikan angket ini? Jika iya maka anda tidak dapat mengubah jawaban kuis ini kembali.
                    </p>
                    ${alert_not_answered}
                `,
                showCloseButton: true,
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonText: 'Kirim semua dan selesai',
                cancelButtonText: 'Batal',
            }).then(async (result) => {
                if (result.isConfirmed) {
                    await this.axiosFinishAttempt()
                }
            })
        },
        async axiosFinishAttempt() {
            try {
                await axios.post(`${this.url}/angket/${this.id}/finishattempt`, {}, {
                    headers: {
                        Authorization: `Bearer ${this.token}`
                    }
                })
                this.$router.push({ name: 'Angket', query: { id: this.id } })
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
<style>
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

@media (max-width: 340px) {
    .margin-if-small {
        margin-bottom: 6px;
    }
}
</style>