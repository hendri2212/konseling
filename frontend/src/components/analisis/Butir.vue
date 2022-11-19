<template>
    <div>
        <CCard accent-color="primary">
            <CCardHeader>
                Analisis Profil Kelas
                <div class="card-header-actions">
                    <CButton :color="'primary'">
                        <router-link class="text-decoration-none text-white" :to='`/analisis/ujian/${$route.params.id}/siswa`'>Lihat Analisis Setiap Siswa</router-link>
                    </CButton>
                </div>
            </CCardHeader>
        </CCard>
        <CRow>
            <CCol lg="7">
                <CCard accent-color="primary">
                    <CCardBody>
                        <CDataTable
                        :items="items"
                        :fields="fields"
                        column-filter
                        table-filter
                        hover
                        sorter
                        >
                        <template #prioritas="{item}">
                            <td>
                                <CBadge :color="item.prioritas == 'TINGGI' ? 'danger' : (item.prioritas == 'SEDANG' ? 'warning' : 'success')">{{item.prioritas}}</CBadge>
                            </td>
                        </template>
                        </CDataTable>
                    </CCardBody>
                </CCard>
            </CCol>
            <CCol lg="5" style="">
                <CCard accent-color="primary" class="text-black">
                    <CCardBody>
                        <h3 class="text-center">BIDANG LAYANAN</h3>
                        <CChartDoughnut
                        :labels="label"
                        :datasets="[{
                            label: 'My First Dataset',
                            data: data,
                            backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)',
                            'rgb(190, 180, 40)',
                            ],
                            hoverOffset: 4
                        }]">

                        </CChartDoughnut>
                        <div class="table-responsive">
                            <table class="table table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th colspan="2" style="background-color:rgb(255, 99, 132); color:white;">PRIBADI</th>
                                        <th colspan="2" style="background-color:rgb(54, 162, 235); color:white;">SOSIAL</th>
                                        <th colspan="2" style="background-color:rgb(255, 205, 86); color:white;">BELAJAR</th>
                                        <th colspan="2" style="background-color:rgb(190, 180, 40); color:white;">KARIR</th>
                                    </tr>
                                    <tr>
                                        <th>RES</th>
                                        <th>%</th>
                                        <th>RES</th>
                                        <th>%</th>
                                        <th>RES</th>
                                        <th>%</th>
                                        <th>RES</th>
                                        <th>%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td v-for="n in 8" :key="'res'+n">
                                            {{n%2!=0 ? data[(n-1)%4] : prosentase[(n-1)%4]}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>
    </div>
</template>
<script>
import { CChartDoughnut } from '@coreui/vue-chartjs'
const fields = [
    { 
        key: "no", 
        _style: "width:1%",
        filter: false,
    },
    { 
        key: "soal",
        label: "BUTIR  ANGKET KEBUTUHAN PESERTA DIDIK" ,
        filter: false,
    },
    { 
        key: "responden" ,
        label: "JUMLAH RESPONDEN",
        filter: false,
    },
    { 
        key: "prosentase" ,
        label: "PROSENTASE",
        filter: false,
    },
    { 
        key: "prioritas" ,
        label: "PRIORITAS",
        filter: false,
    },
    // {
    //     key: "show_details",
    //     label: "",
    //     _style: "width: 20%",
    //     sorter: false,
    //     filter: false,
    // },
];
export default {
    name: "AnalisisButirSoal",
    components:{
        CChartDoughnut,
    },
    data(){
        return {
            items: [],
            fields,
            label:[],
            data:[],
            prosentase:[],
        }
    },
    created(){
        this.axios.get(`guru/analisis-profile-kelas/${this.$route.params.id}`, {
        headers: {
            Authorization: "Bearer " + this.$store.state.auth.token
        }
        }).then(response => {
            this.items = response.data.list
            this.label = response.data.akumulasi.label
            this.data = response.data.akumulasi.data
            this.prosentase = response.data.akumulasi.prosentase
        })
    },
}
</script>