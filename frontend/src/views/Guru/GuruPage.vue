<template>
    <div>
        <CCard accent-color="primary">
            <CCardHeader>
                Guru

                <div class="card-header-actions">
                    <CButton color="primary" @click="$refs.addModal.setModal(true)">Tambah Guru</CButton>
                    <AddModal @saved="saved" ref="addModal"></AddModal>
                </div>
            </CCardHeader>

            <CCardBody>
                <CDataTable v-if="datatable" :items="items" :fields="fields" table-filter hover>
                    <template #show_details="{ item, index }">
                        <td class="py-2">
                            <CButtonGroup>
                                <CButton size="sm" color="info" @click="$refs.addModal.setModal(true, item)">
                                    Edit
                                </CButton>
                                <CButton size="sm" color="danger"
                                    @click="(deleteData.index = index), (deleteData.name = item.name), (deleteData.modal = true)">
                                    Delete
                                </CButton>
                            </CButtonGroup>
                        </td>
                    </template>
                    <template #under-table>
                        <CPagination :activePage.sync="pagination.active" :pages="pagination.max_page" align="center" />
                    </template>
                </CDataTable>

                <CModal title="Hapus Guru" color="danger" :show.sync="deleteData.modal">
                    <span>Delete akun guru yang bernama {{ deleteData.name }} ?</span>
                    <template #footer>
                        <CButton color="primary" variant="outline" @click="deleteData.modal = false">Close</CButton>
                        <CButton @click="remove">Yes</CButton>
                    </template>
                </CModal>
            </CCardBody>
        </CCard>
        <Loading :loading="loading"></Loading>
    </div>
</template>

<script>
import AddModal from "./AddModal.vue"
import Loading from '../../components/Loading.vue'

// fields
const fields = [
    { key: "email", label: 'Email' },
    { key: "name", label: 'Nama' },
    { key: "name", label: 'Status' },
    {
        key: "show_details",
        label: "Action",
        _style: "width: 20%",
        sorter: false,
        filter: false,
    },
];

export default {
    name: "GuruPage",
    components: {
        AddModal,
        Loading,
    },
    data() {
        return {
            loading: true,
            datatable: true,
            pagination: {
                max_page: 1,
                active: 1,
            },
            items: [],
            fields,
            deleteData: {
                index: -1,
                name: '',
                modal: false,
            },
        };
    },
    async mounted() {
        this.getData()
    },
    methods: {
        async getData() {
            this.loading = true
            try {
                const { data } = await this.axios.get('teachers', {
                    headers: {
                        Authorization: "Bearer " + this.$store.state.auth.token
                    }
                })
                this.items = data.data
                this.pagination.max_page = data.pagination.max_page
            } catch (e) {
                console.log(e)
            } finally {
                this.loading = false
            }
        },
        async forceRerender() {
            this.datatable = false;
            await this.$nextTick();
            this.datatable = true;
        },
        async saved() {
            this.getData()
            this.forceRerender()
        },
        async remove() {
            if (this.deleteData.index == -1 || !this.items[this.deleteData.index]) {
                this.deleteData.modal = false
                return;
            }
            this.loading = true
            try {
                const { data } = await this.axios.delete(`teachers/${this.items[this.deleteData.index].id}`, {
                    headers: {
                        Authorization: "Bearer " + this.$store.state.auth.token
                    }
                })
                await this.$swal({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                })
            } catch (e) {
                var icon = 'error'
                var title = 'Terjadi Kesalahan'
                var text = 'Terjadi Kesalahan di aplikasi'
                if (e.response.status == 422) {
                    text = ''
                    icon = 'warning'
                    for (var key in e.response.errors) {
                        text += e.response.errors[key] + "<br>"
                    }
                }
                await this.$swal({
                    icon: icon,
                    title: title,
                    html: text,
                })
            } finally {
                this.deleteData.index = -1
                this.deleteData.modal = false
                this.loading = false
                this.getData()
            }
        },
    },
};
</script>