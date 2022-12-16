<template>
  <form @submit.prevent="save">
    <CModal :title="insertModal ? 'Tambah Angket' : 'Edit Angket'" color="primary" :show.sync="showModal"
      :centered="true">
      <CRow>
        <CCol sm="12">
          <CInput label="Deskripsi Angket" placeholder="Masukkan deskripsi angket" v-model="nama" />
        </CCol>
        <CCol sm="12">
          <label> Kelas </label>
          <search-input ref="search_input_kelas" :url="'guru/kelas'" v-model="kelas" placeholder="Cari ...">
            <template v-slot="{ data }">
              <span>{{ data.nama }}</span>
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
                  <td>{{ kelas.nama }}</td>
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
      <Loading ref="loading"></Loading>
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
      tmp: null,
      id: '',
      nama: '',
      kelas: null,
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
      this.id = ''
      this.nama = ''
      this.kelas = null
      if (this.tmp != null) {
        this.id = this.tmp.id
        this.nama = this.tmp.nama
        this.kelas = this.tmp.kelas
      }
    },
    setModal(stat, data = '') {
      this.showModal = stat;
      if (data != '') {
        this.insertModal = false;
        this.id = data.id
        this.nama = data.nama
        this.kelas = data.kelas
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
          if (this.kelas != null) {
            payload.kelas_id = this.kelas.id
          }
          const { data } = await this.axios.post("guru/angket", payload, {
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
          if (this.kelas != null) {
            payload.kelas_id = this.kelas.id
          }
          const { data } = await this.axios.put(`guru/angket/${this.id}`, payload, {
            headers: {
              Authorization: "Bearer " + this.$store.state.auth.token
            }
          })
          this.tmp = {
            id: this.id,
            nama: this.nama,
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

<style>

</style>