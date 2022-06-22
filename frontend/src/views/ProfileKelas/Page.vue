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
                        <router-link class="btn btn-primary" :to='`/analisis/kelas/${item.id}`'>Lihat Ujian</router-link>
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
        _style: "width:1%" },
    { 
        key: "nama",
        label: "kelas" 
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
    name: "ProfilKelasPage",
    data(){
        return {
            items: [],
            fields,
        }
    },
    created(){
        this.axios.get('guru/kelas', {
        headers: {
            Authorization: "Bearer " + this.$store.state.auth.token
        }
        }).then(response => {
            var data = response.data.data.map( (data, index) => ({...data, no:index+1}) );
            this.items = data
        })
    },
}
</script>)