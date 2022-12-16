<template>
  <form @submit.prevent="save">
    <CModal :title="insertModal ? 'Tambah Guru' : 'Edit Guru'" color="primary" :centered="true" :show.sync="showModal">
      <CRow>
        <CCol sm="12">
          <CInput label="Nama Kelas" placeholder="Masukkan Kelas" v-model="nama" />
        </CCol>
        <CCol sm="12">
          <label> Guru </label>
          <search-input ref="search_input_guru" :url="'sekolah/guru'" v-model="guru" placeholder="Cari ...">
            <template v-slot="{ data }">
              <span>{{ data.nama }}</span>
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
                  <td>{{ guru.nama }}</td>
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

      <Loading ref="loading"></Loading>
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
        this.nama = this.tmp.nama
        this.guru = this.tmp.guru
      }
    },
    setModal(stat, data = '') {
      this.showModal = stat;
      if (data != '') {
        this.insertModal = false;
        this.id = data.id
        this.nama = data.nama
        this.guru = data.guru
        this.tmp = data
      } else {
        this.insertModal = true;
      }
    },
    async save() {
      this.$refs.loading.show()
      try {
        if (this.insertModal) {
          let payload = {
            nama: this.nama,
          }
          if (this.guru != null) {
            payload.guru_id = this.guru.id
          }
          const { data } = await this.axios.post("sekolah/kelas", payload, {
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
            nama: this.nama
          }
          if (this.guru != null) {
            payload.guru_id = this.guru.id
          }
          const { data } = await this.axios.put(`sekolah/kelas/${this.id}`, payload, {
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
      this.$refs.loading.hide()
    },
  },
};
</script>