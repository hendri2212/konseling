<template>
    <div>
        <CCard accent-color="primary">
            <CCardHeader>
                <h1>Anggota Kelas '{{ class_data.name }}'</h1>
            </CCardHeader>

            <CCardBody>
                <CRow>
                    <CCol sm="5">
                        <h3>Anggota kelas</h3>
                        <select class="form-control" multiple="true" v-model="member_of_class_selected">
                            <option v-for="p in member_of_class" :key="p.id" :value="p.value">{{ p.label }}</option>
                        </select>
                    </CCol>
                    <CCol sm="3" class="d-flex flex-column justify-content-center">
                        <CButton color="secondary" class="mb-2" @click="assign">
                            <CIcon name="cil-arrow-left" class="mr-1" />Tambah
                        </CButton>
                        <CButton color="secondary" @click="hapus">Hapus
                            <CIcon name="cil-arrow-right" class="ml-1" />
                        </CButton>
                    </CCol>
                    <CCol sm="4">
                        <h3>Semua siswa</h3>
                        <select class="form-control" multiple="true" v-model="students_selected">
                            <option v-for="p in students" :key="p.id" :value="p.value">{{ p.label }}</option>
                        </select>
                    </CCol>
                </CRow>
            </CCardBody>
        </CCard>
        <Loading :loading="loading"></Loading>
    </div>
</template>
  
<script>
import Loading from '../../components/Loading.vue'

export default {
    name: "Assign",
    components: {
        Loading,
    },
    data() {
        return {
            loading: true,
            class_data: {
                name: '',
            },
            member_of_class: [],
            member_of_class_selected: [],
            students: [],
            students_selected: [],
        }
    },
    async mounted() {
        this.getData()
    },
    methods: {
        async getData() {
            this.loading = true
            try {
                await this.getKelas()
                await this.getSiswa()
            } catch (e) {
                console.log(e)
            } finally {
                this.loading = false
            }
        },
        async getKelas() {
            const { data: kelas } = await this.axios.get(`classes/${this.$route.query.kelas}`, {
                headers: {
                    Authorization: "Bearer " + this.$store.state.auth.token
                }
            })
            this.class_data.name = kelas.data.name
            this.member_of_class = kelas.data.students.map(p => {
                return {
                    value: p.id,
                    label: p.name + " (" + p.email + ")"
                }
            })
        },
        async getSiswa() {
            const { data: siswa } = await this.axios.get(`students?punya_kelas=false`, {
                headers: {
                    Authorization: "Bearer " + this.$store.state.auth.token
                }
            })
            this.students = siswa.data.map(p => {
                return {
                    value: p.id,
                    label: p.name + " (" + p.email + ")"
                }
            })
        },
        async assign() {
            if (this.students_selected.length > 0) {
                try {
                    this.loading = true
                    await this.axios.post(`classes/${this.$route.query.kelas}/assign`, {
                        student_id: this.students_selected,
                    }, {
                        headers: {
                            Authorization: "Bearer " + this.$store.state.auth.token
                        }
                    })
                    this.students_selected = []
                    await this.getData()
                } catch (e) {
                    console.log(e)
                } finally {
                    this.loading = false
                }
            }
        },
        async hapus() {
            if (this.member_of_class_selected.length > 0) {
                try {
                    this.loading = true
                    await this.axios.post(`classes/${this.$route.query.kelas}/unassign`, {
                        student_id: this.member_of_class_selected,
                    }, {
                        headers: {
                            Authorization: "Bearer " + this.$store.state.auth.token
                        }
                    })
                    this.member_of_class_selected = []
                    await this.getData()
                } catch (e) {
                    console.log(e)
                } finally {
                    this.loading = false
                }
            }
        }
    }
};
</script>
