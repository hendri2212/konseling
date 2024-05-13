<template>
    <div>
        <CRow>
            <CCol class="transition" :lg="!add_rpl_state ? '12' : '5'">
                <CCard accent-color="primary">
                    <CCardBody>
                        <CButton color="primary" class="mb-3" @click="moveComponent('AddRplKlasikal')">Tambah RPL</CButton>
                        <CDataTable :responsive="true" :items="items" :fields="fields" hover>
                            <template #order="{ index }">
                                <td>{{ index + 1 }}</td>
                            </template>
                        </CDataTable>
                    </CCardBody>
                </CCard>
            </CCol>
            <!-- <CCol v-if="add_rpl_state" lg="7">
                <CCard class="position-sticky" style="top:140px;" accent-color="primary">
                    <CCardBody>
                        <CRow>
                            <CCol sm="12">
                                <CInput label="Name" placeholder="Enter your name" />
                            </CCol>
                        </CRow>
                        <CRow>
                            <CCol sm="12">
                                <CInput label="Credit Card Number" placeholder="0000 0000 0000 0000" />
                            </CCol>
                        </CRow>
                        <CRow>
                            <CCol sm="4">
                                <CSelect label="Month" :options="[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]" />
                            </CCol>
                            <CCol sm="4">
                                <CSelect label="Year"
                                    :options="[2014, 2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025]" />
                            </CCol>
                            <CCol sm="4">
                                <CInput label="CVV/CVC" placeholder="123" />
                            </CCol>
                        </CRow>
                    </CCardBody>
                </CCard>
            </CCol> -->
        </CRow>
    </div>
</template>
<script>
import moment from 'moment'

const fields = [
    { label: 'No', key: 'order' },
    // { label: 'Butir Angket', key: 'question' },
    { label: 'ID Survey', key: 'survey_id' },
    { label: 'ID Survery Item', key: 'survey_item_id' }
]

export default {
    name: "ListRplKlasikal",
    props: ['moveComponent'],
    data() {
        return {
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
                const { data } = await this.axios.get(`surveys/${this.survey_id}/service-implementation-plans?service_strategy=klasikal`, {
                    headers: {
                        Authorization: "Bearer " + this.$store.state.auth.token
                    }
                })
                this.items = data.data
            } catch (e) {
                console.log(e)
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