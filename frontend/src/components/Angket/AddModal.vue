<template>
    <form @submit.prevent="save">
        <CModal :title="insertModal ? 'Tambah Angket' : 'Edit Angket'" color="primary" :show.sync="showModal"
            :centered="true">
            <CRow>
                <CCol sm="12">
                    <CInput label="Deskripsi Angket" placeholder="Masukkan deskripsi angket" v-model="name" />
                </CCol>
                <CCol sm="12">
                    <label> Kelas </label>
                    <search-input ref="search_input_kelas" :url="classesUrl" v-model="kelas" placeholder="Cari ...">
                        <template v-slot="{ data }">
                            <span>{{ data.name }}</span>
                        </template>
                    </search-input>
                    <div class="table-responsive no-min-height" v-if="kelas != null">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ kelas.name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="text-danger text-center mt-2" v-else>
                        Belum memilih kelas
                    </p>
                </CCol>
            </CRow>

            <template #footer>
                <div class="d-flex justify-content-between w-100">
                    <CButton class="text-danger" @click="reset()">Reset</CButton>
                    <div>
                        <CButton class="mr-2 px-4" color="secondary" @click="showModal = false">Close</CButton>
                        <CButton type="submit" class="px-5" color="primary">Save</CButton>
                    </div>
                </div>
            </template>
            <Loading :loading="loading"></Loading>
        </CModal>
    </form>
</template>
<script>
import Loading from '@/components/Loading.vue'
import SearchInput from '@/components/SearchInput.vue'
export default {
    name: "AddModal",
    components: {
        Loading,
        SearchInput,
    },
    data() {
        return {
            loading: false,
            tmp: null,
            id: '',
            name: '',
            kelas: null,
            insertModal: true,
            showModal: false,
        };
    },
    computed: {
        classesUrl() {
            // ✅ PERBAIKAN: Hanya return endpoint, bukan full URL
            // Karena axios sudah punya baseURL: http://127.0.0.1:8000/api/admin/
            return 'classes'
        }
    },
    created() {
        this.$watch(
            () => this.showModal,
            (n) => {
                if (!n && !this.insertModal) {
                    this.tmp = null
                    this.reset()
                }
            }
        )
    },
    methods: {
        reset() {
            this.id = ''
            this.name = ''
            this.kelas = null
            if (this.tmp != null) {
                this.id = this.tmp.id
                this.name = this.tmp.name
                this.kelas = this.tmp.kelas
            }
        },
        setModal(stat, data = '') {
            this.showModal = stat;
            if (data != '') {
                this.insertModal = false;
                this.id = data.id
                this.name = data.name
                this.kelas = data.kelas
                this.tmp = data
            } else {
                this.insertModal = true;
            }
        },
        handleUnauthorized() {
            this.$swal({
                icon: 'error',
                title: 'Sesi Berakhir',
                text: 'Sesi Anda telah berakhir. Silakan login kembali.',
            }).then(() => {
                this.$router.push('/login');
            });
        },
        async save() {
            this.loading = true
            try {
                if (this.insertModal) {
                    let payload = {
                        name: this.name,
                    }
                    if (this.kelas != null) {
                        payload.kelas_id = this.kelas.id
                    }
                    const { data } = await this.axios.post("surveys", payload, {
                        headers: {
                            Authorization: "Bearer " + this.$store.state.auth.token
                        }
                    })
                    this.reset()
                    this.$emit('saved')
                    await this.$swal({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                    })
                } else {
                    let payload = {
                        name: this.name
                    }
                    if (this.kelas != null) {
                        payload.kelas_id = this.kelas.id
                    }
                    const { data } = await this.axios.put(`angket/${this.id}`, payload, {
                        headers: {
                            Authorization: "Bearer " + this.$store.state.auth.token
                        }
                    })
                    this.tmp = {
                        id: this.id,
                        name: this.name,
                        kelas: this.kelas,
                    }
                    this.$emit('saved')
                    await this.$swal({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                    })
                }
            } catch (e) {
                var icon = 'error'
                var title = 'Terjadi Kesalahan'
                var text = 'Terjadi Kesalahan di aplikasi'

                if (e.response?.status === 401) {
                    this.handleUnauthorized();
                    return;
                }

                if (e.response?.status == 422) {
                    text = ''
                    icon = 'warning'
                    for (var key in e.response.data.errors) {
                        text += e.response.data.errors[key] + "<br>"
                    }
                }

                await this.$swal({
                    icon: icon,
                    title: title,
                    html: text,
                })
            }
            this.loading = false
        },
    },
};
</script>
