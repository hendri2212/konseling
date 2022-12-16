<template>
    <CCard accent-color="primary">
        <CCardHeader>
            Analisis Profil Kelas

            <div class="card-header-actions">
                <CButton :color="'primary'">
                    <router-link class="text-decoration-none text-white" :to='`/analisis/angket/${$route.params.id}/butir`'>Lihat Analisis Setiap Soal</router-link>
                </CButton>
            </div>
        </CCardHeader>

        <CCardBody>
            <CDataTable
            :items="items"
            :fields="fields"
            column-filter
            table-filter
            hover
            sorter
            >
                <!-- <template #show_details="{item}">
                    <td class="py-2">
                        <router-link :to='`/analisis/profil-kelas/${item.id}`'>View</router-link>
                    </td>
                </template> -->
            </CDataTable>
        </CCardBody>
    </CCard>
</template>
<script>
const fields = [
    { 
        key: "no", 
        _style: "width:1%",
        filter: false,
    },
    { 
        key: "nisn",
        label: "NISN" ,
        filter: false,
    },
    { 
        key: "nama" ,
        label: "NAMA",
        filter: false,
    },
    { 
        key: "jumlah" ,
        label: "JUMLAH",
        filter: false,
    },
    { 
        key: "prosentase" ,
        label: "%",
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
    name: "AnalisisSiswa",
    data(){
        return {
            items: [],
            fields,
        }
    },
    created(){
        this.axios.get(`guru/analisis-profile-konseling/${this.$route.params.id}`, {
        headers: {
            Authorization: "Bearer " + this.$store.state.auth.token
        }
        }).then(response => {
            this.items = response.data
        })
    },
}
</script>