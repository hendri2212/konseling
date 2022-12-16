<template>
    <CCard accent-color="primary">
        <CCardHeader>
            Analisis Profil Kelas

            <div class="card-header-actions">
            </div>
        </CCardHeader>

        <CCardBody>
            <CDataTable
            :items="items"
            :fields="fields"
            column-filter
            table-filter
            items-per-page-select
            :items-per-page="5"
            hover
            sorter
            pagination
            >
                <template #show_details="{item}">
                    <td class="py-2">
                        <router-link class="btn btn-info" :to='`/analisis/angket/${item.id}/butir`'>Analisis Profile Kelas</router-link>
                        <router-link class="btn btn-primary" :to='`/analisis/angket/${item.id}/siswa`'>Analisis Profile Konseling</router-link>
                    </td>
                </template>
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
        key: "nama",
        label: "Angket" 
    },
    { 
        key: "tanggal" 
    },
    {
        key: "show_details",
        label: "",
        _style: "width: 20%",
        sorter: false,
        filter: false,
    },
];
export default {
    name: "ProfilePerKelasPage",
    data(){
        return {
            items: [],
            fields,
        }
    },
    created(){
        this.axios.get(`guru/angket/kelas/${this.$route.params.id}`, {
        headers: {
            Authorization: "Bearer " + this.$store.state.auth.token
        }
        }).then(response => {
            var data = response.data.data.map( (data, index) => ({...data, no:index+1}) );
            this.items = data
        })
    },
}
</script>