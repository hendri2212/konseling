<template>
    <div>
        <CRow>
            <CCol class="transition" :lg="!add_rpl_state ? '12' : '5'">
                <CCard accent-color="primary">
                    <CCardBody>
                        <CButton color="primary" class="mb-3"
                            @click="$router.push({ name: 'AddRplKlasikal', query: $route.query })">Tambah RPL
                        </CButton>
                        <CDataTable :responsive="true" :items="items" :loading="loading" :fields="fields" hover>
                            <template #order="{ index }">
                                <td>{{ index + 1 }}</td>
                            </template>
                            <template #question="{ item }">
                                <td>{{ item.survey_item.question }}</td>
                            </template>
                            <template #action="{ item }">
                                <td>
                                    <CButton color="info" class="mr-1">
                                        <router-link class="text-decoration-none text-white d-flex"
                                            :to='{ name: "CetakRplKlasikal", query: { ...$route.query, sip_id: item.id } }'>
                                            <CIcon class="mr-1" name="cil-print" /> Cetak
                                        </router-link>

                                    </CButton>
                                    <CButton color="danger">
                                        <span class="d-flex">
                                            <CIcon class="mr-1" name="cil-trash" /> Hapus
                                        </span>
                                    </CButton>
                                </td>
                            </template>
                        </CDataTable>
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>
    </div>
</template>
<script>
// import router from '@/router'
import moment from 'moment'

const fields = [
    { label: 'No', key: 'order' },
    { label: 'Butir Angket', key: 'question' },
    { label: '', key: 'action' },
]

export default {
    name: "ListRpl",
    data() {
        return {
            loading: true,
            fields: fields,
            items: [],
            add_rpl_state: false,
        }
    },
    computed: {
        survey_id() {
            return this.$route.query.id
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!to.query.id) {
            next({ name: "Angket" })
        }
        next()
    },
    created() {
        this.getData()
    },
    methods: {
        dateTime(value) {
            return moment(new Date(value)).format('dddd, DD MMMM YYYY, HH:mm');
        },
        duration(start, finish) {
            return moment().endOf(new Date(finish)).from(new Date(start));
        },
        async getData() {
            this.loading = true
            try {
                const { data } = await this.axios.get(`surveys/${this.survey_id}/service-implementation-plan-klasikals`, {
                    headers: {
                        Authorization: "Bearer " + this.$store.state.auth.token
                    }
                })
                this.items = data.data
            } catch (e) {
                if (e.response.status === 400) {
                    await this.$swal({
                        icon: 'error',
                        title: 'Request tidak valid !',
                        html: e.response.data.message,
                    })
                }
            } finally {
                this.loading = false
            }
        },
    }
}
</script>
<style>
.table td {
    vertical-align: middle !important;
}

.transition {
    transition: .5s;
}
</style>