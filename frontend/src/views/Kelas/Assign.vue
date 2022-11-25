<template>
    <div>
        <CCard accent-color="primary">
            <CCardHeader>
                <h1>Anggota Kelas '{{ kelas.nama }}'</h1>
            </CCardHeader>

            <CCardBody>
                <CRow>
                    <CCol sm="5">
                        <h3>Anggota kelas</h3>
                        <CSelect :options="siswa" multiple v-model="anggota_kelas_selected">
                        </CSelect>
                    </CCol>
                    <CCol sm="3" class="d-flex flex-column justify-content-center">
                        <CButton color="secondary" class=" mb-2"><CIcon name="cil-arrow-left" class="mr-1" />Tambah</CButton>
                        <CButton color="secondary" class="">Hapus<CIcon name="cil-arrow-right" class="ml-1" /></CButton>
                    </CCol>
                    <CCol sm="4">
                        <h3>Semua siswa</h3>
                        <CSelect :options="siswa" multiple>
                        </CSelect>
                    </CCol>
                </CRow>
            </CCardBody>
        </CCard>
        <Loading ref="loading"></Loading>
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
            kelas: {
                nama: '',
            },
            siswa: [
                {
                    value: 1,
                    label: 'syarif'
                },
                {
                    value: 2,
                    label: 'hidayatullah'
                },
            ],
            anggota_kelas_selected: [],
        }
    },
};
</script>
