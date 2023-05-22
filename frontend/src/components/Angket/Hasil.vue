<template>
    <CCard accent-color="primary">
        <CCardBody>
            <CDataTable :responsive="true" :items="items" :fields="fields" hover>
                <template #ProfileSiswa="{ item }">
                    <td>
                        <div style="width:50px; height:50px; line-height:45px; font-size:1.5em;"
                            class="bg-secondary text-white text-center rounded-circle">{{ item.name[0] }}
                        </div>
                    </td>
                </template>
                <template #result_as_percent="{ item }">
                    <td>
                        {{ `${item.result_as_percent}%` }}
                    </td>
                </template>
            </CDataTable>
        </CCardBody>
    </CCard>
</template>
<script>

import moment from 'moment'

const fields = [
    { label: '', key: 'ProfileSiswa' },
    { label: 'Nama', key: 'name' },
    { label: 'Status', key: 'state' },
    { label: 'Dimulai pada', key: 'timestart' },
    { label: 'Selesai', key: 'timefinish' },
    { label: 'Waktu mengerjakan', key: 'time' },
    { label: '%', key: 'result_as_percent' }
]

export default {
    name: "Hasil",
    data() {
        return {
            fields: fields,
            items: [],
            pagination: {
                max_page: 10
            }
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
            var x = new moment(start)
            var y = new moment(finish)
            var duration = moment.duration(y.diff(x, "seconds"), "seconds").humanize()
            return duration
        },
        async getData(param = null) {
            let page = param ?? 1
            this.loading = true
            try {
                const { data } = await this.axios.get(`surveys/${this.survey_id}/results?page=${page}`, {
                    headers: {
                        Authorization: "Bearer " + this.$store.state.auth.token
                    }
                })
                this.items = data.data.map(item => {
                    item.time = this.duration(item.timestart, item.timefinish)
                    item.timestart = this.dateTime(item.timestart)
                    if (item.timefinish) {
                        item.timefinish = this.dateTime(item.timefinish)
                    }
                    return item
                })
                this.pagination.max_page = data.pagination.max_page
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