<template>
    <form @submit.prevent="save">
        <CModal :title="insertModal ? 'Tambah Guru' : 'Edit Guru'" color="primary" :centered="true"
            :show.sync="showModal">
            <CRow>
                <CCol sm="12">
                    <CInput label="Nama Kelas" placeholder="Masukkan Kelas" v-model="nama" />
                </CCol>
                <CCol sm="12">
                    <label> Guru </label>
                    <search-input ref="search_input_guru" :url="'teachers'" v-model="guru" placeholder="Cari ...">
                        <template v-slot="{ data }">
                            <span>{{ data.name }}</span>
                        </template>
                    </search-input>
                    <div class="table-responsive no-min-height" v-if="guru != null">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ guru.name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="text-danger text-center mt-2" v-else>
                        Belum memilih guru
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
    name: "AddModalKelas",
    components: {
        Loading,
        SearchInput,
    },
    data() {
        return {
            loading: false,
            tmp: null,
            id: '',
            nama: '',
            guru: null,
            insertModal: true,
            showModal: false,
        };
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
            this.id = ""
            this.nama = ""
            this.guru = null
            if (this.tmp != null) {
                this.id = this.tmp.id
                // support both shapes: { name, teacher } and legacy { nama, guru }
                this.nama = this.tmp.name ?? this.tmp.nama ?? ""
                this.guru = this.tmp.teacher ?? this.tmp.guru ?? null
            }
        },
        setModal(stat, data = '') {
            this.showModal = stat;
            if (data != '') {
                this.insertModal = false;
                this.id = data.id
                // Map incoming item fields to local state
                this.nama = data.name ?? data.nama ?? ""
                this.guru = data.teacher ?? data.guru ?? null
                // Keep a normalized snapshot for reset
                this.tmp = { id: this.id, name: this.nama, teacher: this.guru }
            } else {
                this.insertModal = true;
            }
        },
        async save() {
            this.loading = true
            try {
                if (this.insertModal) {
                    let payload = {
                        name: this.nama,
                    }
                    if (this.guru != null) {
                        payload.teacher_id = this.guru.id
                    }
                    const { data } = await this.axios.post("classes", payload, {
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
                        name: this.nama
                    }
                    if (this.guru != null) {
                        payload.teacher_id = this.guru.id
                    }
                    const { data } = await this.axios.put(`classes/${this.id}`, payload, {
                        headers: {
                            Authorization: "Bearer " + this.$store.state.auth.token
                        }
                    })
                    this.tmp = {
                        id: this.id,
                        nama: this.nama,
                        guru: this.guru,
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
                if (e.response.status == 422) {
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
