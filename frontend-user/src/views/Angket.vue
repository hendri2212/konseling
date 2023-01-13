<template>
    <layout-default :error="error" :message="message">
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <div class="card">
                            <div class="d-flex align-items-end row">
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <h3 class="text-primary">{{ nama }}</h3>
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item">
                                                    <router-link :to="{ name: 'Dashboard' }">Dashboard</router-link>
                                                </li>
                                                <li class="breadcrumb-item active">{{ nama }}</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <div class="card">
                            <div class="d-flex align-items-end row">
                                <div class="col-sm-12">
                                    <div class="card-body">
                                        <button class="btn btn-primary mb-3">Isi Angket</button>
                                        <p class="m-0">Diizinkan mengisi angket : 1</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </layout-default>
</template>
<script>
import LayoutDefault from '../components/layout/LayoutDefault.vue';
import axios from 'axios'
import { mapState } from 'pinia'
import { useAuthStore } from '@/stores/auth'
export default {
    name: "Angket",
    components: {
        LayoutDefault,
    },
    computed: {
        ...mapState(useAuthStore, ['token'])
    },
    data() {
        return {
            error: false,
            message: "",
            url: import.meta.env.VITE_API_URL,
            nama: "",
        }
    },
    async mounted() {
        if (this.$route.query.id.trim() == '') {
            this.error = true
            this.message = "ID angket tidak valid"
            return;
        }

        try {
            const { data } = await axios.get(`${this.url}/angket/${this.$route.query.id.trim()}`, {
                headers: {
                    Authorization: `Bearer ${this.token}`
                }
            })
            this.nama = data.data.nama
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
</script>