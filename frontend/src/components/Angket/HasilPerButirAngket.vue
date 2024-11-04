<template>
    <CCard accent-color="primary">
        <CCardBody>
            <CDataTable :responsive="true" :items="items" :fields="fields" hover>

            </CDataTable>
        </CCardBody>
    </CCard>
</template>
<script>

import moment from 'moment'

const fields = [
    { label: 'No', key: 'order' },
    { label: 'Butir Angket', key: 'question' },
    { label: 'Jml Responden', key: 'students_count' },
    { label: '%', key: 'result_as_percent' },
]

export default {
    name: "HasilPerButirAngket",
    data() {
        return {
            fields: fields,
            items: [],
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
                const { data } = await this.axios.get(`surveys/${this.survey_id}/result-per-survey-items`, {
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
</style>