<template>
    <layout-default :error="false">
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <router-link :to="{ name: 'Angket', query: { id: data.id } }" class="col-lg-3 col-md-4 col-sm-6 col-xs-12" v-for="data in angket">
                        <div class="card h-100">
                            <div class="card-img-top" :style="`background-image:${geopattern_generate(data.id)};`"></div>
                            <div class="card-body">
                                <small>{{ data.tanggal }}</small>
                                <h5 class="card-title">{{ data.nama }}</h5>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </layout-default>
</template>

<script>
import LayoutDefault from '../components/layout/LayoutDefault.vue';
import GeoPattern from 'geopattern'
import axios from 'axios'
import { mapState } from 'pinia'
import { useAuthStore } from '@/stores/auth'
export default {
    name: "Dashboard",
    components: {
        LayoutDefault,
    },
    data() {
        return {
            url: import.meta.env.VITE_API_URL,
            angket: [],
        }
    },
    computed: {
        ...mapState(useAuthStore, ['token'])
    },
    async mounted() {
        this.getData()
    },
    methods: {
        geopattern_generate(id = '') {
            return GeoPattern.generate(id.toString()).toDataUrl()
        },
        async getData() {
            const { data } = await axios.get(`${this.url}/angket`, {
                headers: {
                    Authorization: `Bearer ${this.token}`
                }
            })
            data.data.forEach(element => {
                this.angket.push(element)
            });
        },
    }
}
</script>
<style>
.card-img-top {
    height: 7rem;
    background-position: center;
    -webkit-background-size: cover;
    background-size: cover;
    width: 100%;
}
.card-title:hover {
    text-decoration: underline;
}
</style>